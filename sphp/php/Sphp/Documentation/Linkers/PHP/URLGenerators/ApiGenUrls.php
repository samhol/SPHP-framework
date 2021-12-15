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
 * ApiGen URL string generator pointing to an existing ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ApiGenUrls implements PHPApiUrlGenerator {

  private ApiDocURLBuilder $urlGen;

  /**
   * Constructor
   * 
   * @param string $root
   * @param string $name
   */
  public function __construct(string $root, string $name = 'ApiGen') {
    $this->urlGen = new ApiDocURLBuilder($root, $name);
  }

  public function __destruct() {
    unset($this->urlGen);
  }

  public function getRootUrl(): ?string {
    return $this->urlGen->getRootUrl();
  }

  public function getNamespaceUrl(string $namespace): string {
    $ns = trim($namespace, "\\");
    if ($ns === '') {
      $ns = 'none';
    } else {
      $ns = str_replace('\\', '.', $ns);
    }
    return $this->urlGen->createUrl("namespace-$ns.html");
  }

  public function getClassUrl(string $class): string {
    $parsedClass = str_replace('\\', '.', $class);
    return $this->urlGen->createUrl("class-$parsedClass.html");
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    $parsedClass = str_replace('\\', '.', $class);
    return $this->urlGen->createUrl("class-$parsedClass.html#$constant");
  }

  public function getClassPropertyUrl(string $class, string $property): string {
    $parsedClass = str_replace('\\', '.', $class);
    return $this->urlGen->createUrl("class-$parsedClass.html#$$property");
  }

  public function getClassMethodUrl(string $class, string $method): string {
    $parsedClass = str_replace('\\', '.', $class);
    return $this->urlGen->createUrl("class-$parsedClass.html#_$method");
  }

  public function getFunctionUrl(string $function): string {
    $parsedFunction = str_replace('\\', '.', $function);
    return $this->urlGen->createUrl("function-$parsedFunction.html");
  }

  public function getConstantUrl(string $constant): string {
    $parsedConstant = str_replace('\\', '.', $constant);
    return $this->urlGen->createUrl("constant-$parsedConstant.html");
  }

  public function getApiname(): string {
    return $this->urlGen->getApiname();
  }

}
