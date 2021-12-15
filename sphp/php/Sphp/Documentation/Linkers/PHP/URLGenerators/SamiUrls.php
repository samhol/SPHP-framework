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
class SamiUrls implements PHPApiUrlGenerator {

  private ApiDocURLBuilder $urlGen;

  /**
   * Constructor
   * 
   * @param string|null $root
   * @param string $name
   */
  public function __construct(?string $root, string $name = 'Sami PHP documentation') {
    $this->urlGen = new ApiDocURLBuilder($root, $name);
  }

  public function __destruct() {
    unset($this->urlGen);
  }

  public function getRootUrl(): ?string {
    return $this->urlGen->getRootUrl();
  }

  public function getNamespaceUrl(string $namespace): string {
    $ns = str_replace('\\', '/', trim($namespace, '\\'));
    return $this->urlGen->createUrl("$ns.html");
  }

  public function getClassUrl(string $class): string {
    $parsedClass = str_replace('\\', '/', $class);
    return $this->urlGen->createUrl("$parsedClass.html");
  }

  public function getClassConstantUrl(string $class, string $constant): string {
    return $this->getClassUrl($class);
  }

  public function getClassPropertyUrl(string $class, string $property): string {
    $sanitized = ltrim($property, '$');
    return $this->getClassUrl($class) . "#property_$sanitized";
  }

  public function getClassMethodUrl(string $class, string $method): string {
    $sanitized = str_replace('()', '', $method);
    return $this->getClassUrl($class) . "#method_$sanitized";
  }

  public function getFunctionUrl(string $function): string {
    return $this->getRootUrl() . 'search.html';
  }

  public function getConstantUrl(string $constant): string {
    return $this->getRootUrl() . 'search.html';
  }

  public function getApiname(): string {
    return $this->urlGen->getApiname();
  }

}
