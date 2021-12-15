<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\URLGenerators;

use Sphp\Documentation\Linkers\ApiDocURLBuilder;
use Sphp\Documentation\Linkers\PHP\PHPApiUrlGenerator;

/**
 * URL string generator pointing to an existing Sami documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PhpDocUrls implements PHPApiUrlGenerator {

  private ApiDocURLBuilder $urlGen;

  /**
   * Constructor
   * 
   * @param string|null $root
   * @param string $name
   */
  public function __construct(?string $root, string $name = 'PhpDoc') {
    $this->urlGen = new ApiDocURLBuilder($root, $name);
  }

  public function __destruct() {
    unset($this->urlGen);
  }

  protected function getNamespacePath(string $namespace): string {
    $ns = trim($namespace, '\\');
    if ($ns !== '') {
      $ns = strtolower(str_replace('\\', '-', $ns));
    } else {
      $ns = 'default';
    }
    return "namespaces/$ns.html";
  }

  public function getRootUrl(): ?string {
    return $this->urlGen->getRootUrl();
  }

  public function getNamespaceUrl(string $namespace): string {
    return $this->urlGen->createUrl($this->getNamespacePath($namespace));
  }

  public function getClassUrl(string $class): string {
    $parsedClass = str_replace('\\', '-', trim($class, '\\'));
    return $this->getRootUrl() . "classes/$parsedClass.html";
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    if (defined("$class::$constant")) {
      $ref = new \ReflectionClassConstant($class, $constant);
      $class = $ref->getDeclaringClass()->getName();
    }
    return $this->getClassUrl($class) . "#constant_$constant";
  }

  public function getClassPropertyUrl(string $class, string $property): string {
    if (property_exists($class, $property)) {
      $ref = new \ReflectionProperty($class, $property);
      $class = $ref->getDeclaringClass()->getName();
    }
    return $this->getClassUrl($class) . "#property_$property";
  }

  public function getClassMethodUrl(string $class, string $method): string {
    if (method_exists($class, $method)) {
      $ref = new \ReflectionMethod($class, $method);
      $class = $ref->getDeclaringClass()->getName();
    }
    return $this->getClassUrl($class) . "#method_$method";
  }

  public function getFunctionUrl(string $function): string {
    if (function_exists($function)) {
      $ref = new \ReflectionFunction($function);
      $f = $ref->getShortName();
      $ns = $this->getNamespacePath($ref->getNamespaceName());
    } else {
      $parts = explode('\\', $function);
      $f = array_pop($parts);
      $ns = $this->getNamespacePath(implode('\\', $parts));
    }
    return $this->getRootUrl() . "$ns#function_$f";
  }

  public function getConstantUrl(string $constant): string {
    $parts = explode('\\', $constant);
    $c = array_pop($parts);
    $ns = $this->getNamespacePath(implode('\\', $parts));
    return $this->getRootUrl() . "$ns#constant_$c";
  }

  public function getApiname(): string {
    return $this->urlGen->getApiname();
  }

}
