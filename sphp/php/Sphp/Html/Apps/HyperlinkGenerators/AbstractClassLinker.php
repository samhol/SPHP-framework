<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use ReflectionClass;
use Sphp\Html\Navigation\A;

/**
 * Hyperlink object generator pointing to an existing API documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractClassLinker extends AbstractLinker implements ClassLinker {

  /**
   * class reflector
   *
   * @var ReflectionClass
   */
  protected $ref;

  /**
   * @var ApiUrlGenerator
   */
  private $classUrlGenerator;

  /**
   * Constructor
   *
   * @param string $class class name or object
   * @param ApiUrlGenerator $pathParser
   */
  public function __construct(string $class, ApiUrlGenerator $pathParser) {
    parent::__construct($pathParser);
    $this->ref = new ReflectionClass($class);
    $this->classUrlGenerator = $pathParser;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->ref);
    parent::__destruct();
  }

  public function __clone() {
    $this->ref = new ReflectionClass($this->ref->getName());
    parent::__clone();
  }

  public function __toString(): string {
    return $this->getLink()->getHtml();
  }

  public function classUrlGenerator(): ApiUrlGenerator {
    return $this->classUrlGenerator;
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): A {
    return parent::hyperlink($url, str_replace("\\", "\\<wbr>", $content), $title);
  }

  public function getLink(string $name = null): A {
    if ($name === null) {
      $name = $this->ref->getShortName();
    }
    $longName = $this->ref->getName();
    $classes = [];
    if ($this->ref->isInterface()) {
      $title = "Interface $longName";
      $classes[] = 'interface';
    } else if ($this->ref->isTrait()) {
      $title = "Trait $longName";
      $classes[] = 'trait';
    } else if ($this->ref->isAbstract()) {
      $title = "Abstract class $longName";
      $classes[] = 'abstract-class';
    } else {
      $title = "Class $longName";
      $classes[] = 'instantiable-class';
    }
    return $this->hyperlink($this->urls()->getClassUrl($longName), $name, $title)->addCssClass($classes);
  }

  public function methodLink(string $method, bool $full = true): A {
    if ($full) {
      $text = $this->ref->getShortName() . "::$method()";
    } else {
      $text = "$method()";
    }
    $fullClassName = $this->ref->getName();
    $classes = ['php-class'];
    try {
      $reflectedMethod = $this->ref->getMethod($method);
      if ($reflectedMethod->isConstructor()) {
        $title = "The $fullClassName constructor";
        $classes[] = 'constructor';
      } else if ($reflectedMethod->isDestructor()) {
        $title = "The $fullClassName destructor";
        $classes[] = 'destructor';
      } else if ($reflectedMethod->isStatic()) {
        $title = "Static method: $fullClassName::$reflectedMethod->name()";
        $classes[] = 'static-method';
      } else {
        $title = "Instance method: $fullClassName::$reflectedMethod->name()";
        $classes[] = 'instance-method';
      }
    } catch (\Exception $ex) {
      $title = "Method: $fullClassName::$method()";
    }
    return $this->hyperlink($this->urls()->getClassMethodUrl($fullClassName, $method), $text, $title)->addCssClass($classes);
  }

  public function constantLink(string $constName): A {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    return $this->hyperlink($this->urls()->getClassConstantUrl($this->ref->getName(), $constName), $name, $title);
  }

  public function namespaceLink(bool $full = true): A {
    $fullName = $this->ref->getNamespaceName();
    if (!$full) {
      $namespaceArray = explode('\\', $fullName);
      $name = array_pop($namespaceArray);
    } else {
      $name = $fullName;
    }
    $title = "$fullName namespace";
    return $this->hyperlink($this->urls()->getNamespaceUrl($fullName), $name, $title);
  }

}
