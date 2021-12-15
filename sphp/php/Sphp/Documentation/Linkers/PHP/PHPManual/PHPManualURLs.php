<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\ExtensionDataManager;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * URL string generator pointing to online PHP Manual
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPManualURLs implements PHPApiUrlGenerator, ManualURL {

  private PHPManualUrlBuilder $root;

  /**
   * Constructor
   * 
   * @param PHPManualUrlBuilder|null $root
   */
  public function __construct(?PHPManualUrlBuilder $root = null) {
    if ($root === null) {
      $root = new PHPManualUrlBuilder();
    }
    $this->root = $root;
  }

  public function __destruct() {
    unset($this->root);
  }

  public function getConstantUrl(string $constant): string {
    return $this->root->createUrl(ConstantPathBuilder::instance()($constant));
  }

  public function getExtensionUrl(string $ext): Books\Reference {
    $book = ExtensionDataManager::instance()->getReference($ext, $this->root);
    if ($book === null) {
      throw new NonDocumentedFeatureException($ext);
    }
    return $book;
  }

  public function getLanguageReferenceUrl(string $word): string {
    return $this->root->createUrl(LanguageReferencePathBuilder::path($word));
  }

  /**
   * Sets the language of the PHP documentation
   * 
   * @param  string $lang two letter language code 
   * @return $this for a fluent interface
   */
  public function setLanguage(string $lang) {
    $this->root->setLanguage($lang);
    return $this;
  }

  public function getLanguage(): string {
    return $this->root->getLanguage();
  }

  public function getApiname(): string {
    return $this->root->getApiname();
  }

  public function getClassUrl(string $class): string {
    $parsedClass = URLUtils::parseClassName($class);
    return $this->root->createUrl("class.$parsedClass.php");
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    $pathBuilder = ClassConstantPathBuilder::instance();
    return $this->root->createUrl($pathBuilder($class, $constant));
  }

  public function getClassMethodUrl(string $class, string $method): string {
    if (method_exists($class, $method)) {
      $ref = new \ReflectionMethod($class, $method);
      $class = $ref->getDeclaringClass()->getName();
    }
    $parsedClass = URLUtils::parseClassName($class);
    $parsedMethod = URLUtils::parseFunctionName($method);
    return $this->root->createUrl("$parsedClass.$parsedMethod.php");
  }

  public function getClassPropertyUrl(string $class, string $property): string {
    if (property_exists($class, $property)) {
      $ref = new \ReflectionProperty($class, $property);
      $class = $ref->getDeclaringClass()->getName();
    }
    $parsedClass = URLUtils::parseClassName($class);
    $parsedProperty = URLUtils::parseName($property);
    return $this->root->createUrl("class.$parsedClass.php#$parsedClass.props.$parsedProperty");
  }

  public function getFunctionUrl(string $function): string {
    $name = URLUtils::parseFunctionName($function);
    return $this->root->createUrl("function.$name.php");
  }

  public function getNamespaceUrl(string $namespace): string {
    $name = strtolower(trim($namespace, '\\'));
    $book = ExtensionDataManager::instance()->getReference($name, $this->root);
    return $book->getURL();
  }

  public function getRootUrl(): ?string {
    return $this->root->getRootUrl();
  }

}
