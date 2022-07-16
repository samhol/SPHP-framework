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
use Sphp\Stdlib\Strings;

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

  /**
   * Returns linker properties or hyperlinks
   * 
   * @param  string $name
   * @return ItemLinker
   * @throws NonDocumentedFeatureException
   */
  public function build(string $name): string {
    try {
      if (str_contains($name, '::')) {
        $parts = explode('::', $name);
        list($class, $member) = $parts;
        $url = $this->parseClassMember($class, $member);
      } else if (str_ends_with($name, '()') || function_exists($name)) {
        $url = $this->getFunctionUrl(str_replace('()', '', $name));
      } else if (defined($name)) {
        $url = $this->getConstantUrl($name);
      } else if (class_exists($name) || interface_exists($name) || trait_exists($name)) {
        $url = $this->getClassUrl($name);
      } else if (Strings::match($name, '/^[A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*$/')) {
        $url = $this->getConstantUrl($name);
      } else if (str_starts_with($name, 'ext:')) {
        $bookName = str_replace('ext:', '', $name);
        $url = ExtensionDataManager::instance()->getReference($bookName)?->getURL();
      }else if (PHPWords::fullCollection()->containsWord($name)) {
        $url = $this->languageReference($name);
      } else {
        $url = $this->getNamespaceUrl($name);
      }
      return $url;
    } catch (\Exception $ex) {
      throw new NonDocumentedFeatureException("Invalid type name given ($name)", 0, $ex);
    }
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the given property or method
   * 
   * @param  string $member
   * @return ItemLinker
   * @throws NonDocumentedFeatureException if the class member not found in class
   */
  public function parseClassMember(string $class, string $member): ?string {

    try {
      $link = null;
      if (str_ends_with($member, '()')) {
        $link = $this->getClassMethodUrl($class, $member);
      } else if (str_starts_with($member, '$')) {
        $link = $this->getClassPropertyUrl($class, str_replace('$', '', $member));
      } else if (Strings::match($member, '/^[A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*$/')) {
        $link = $this->getClassConstantUrl($class, $member);
      }
    } catch (\Exception $ex) {
      throw new NonDocumentedFeatureException("Class member not found in class $class", 0, $ex);
    }
    if (!isset($link)) {
      throw new NonDocumentedFeatureException("Class member not found in class");
    }
    return $link;
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
