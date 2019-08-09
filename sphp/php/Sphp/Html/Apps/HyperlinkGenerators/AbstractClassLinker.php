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
use Sphp\Html\Component;

/**
 * Hyperlink object generator pointing to an existing API documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractClassLinker implements ClassLinker {

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
   * @var array
   */
  private $attributes = [];

  /**
   * Constructor
   *
   * @param string $class class name or object
   * @param ApiUrlGenerator $pathParser
   */
  public function __construct(string $class, ApiUrlGenerator $pathParser) {
    $this->ref = new ReflectionClass($class);
    $this->classUrlGenerator = $pathParser;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->classUrlGenerator, $this->ref, $this->attributes);
  }

  public function __clone() {
    $this->ref = new ReflectionClass($this->ref->getName());
    $this->classUrlGenerator = clone $this->classUrlGenerator;
  }

  public function __toString(): string {
    return $this->getLink()->getHtml();
  }

  public function useAttributes(array $attributes) {
    $this->attributes = $attributes;
    return $this;
  }

  /**
   * Sets the default attributes to a given component
   * 
   * @param  Component $a the component to modify
   * @return Component returns the modified component
   */
  public function insertAttributesTo(Component $a): Component {
    if (!empty($this->attributes)) {
      $a->attributes()->merge($this->attributes);
    }
    return $a;
  }

  public function urls(): ApiUrlGenerator {
    return $this->classUrlGenerator;
  }

  protected function buildHyperlink(string $url, string $content, string $title): A {
    if ($content === null) {
      $content = $url;
    }
    $a = new A($url, str_replace("\\", "\\<wbr>", $content));
    if ($title !== null) {
      $a->attributes()->title = $title;
    }
    $this->insertAttributesTo($a);
    return $a;
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
    return $this->buildHyperlink($this->urls()->getClassUrl($longName), $name, $title)->addCssClass($classes);
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
    return $this->buildHyperlink($this->urls()->getClassMethodUrl($fullClassName, $method), $text, $title)->addCssClass($classes);
  }

  public function constantLink(string $constName): A {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    $classes = ['php-class', 'constant'];
    return $this->buildHyperlink($this->urls()->getClassConstantUrl($this->ref->getName(), $constName), $name, $title)->addCssClass($classes);
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
    $classes = ['php-class', 'namespace'];
    return $this->buildHyperlink($this->urls()->getNamespaceUrl($fullName), $name, $title)->addCssClass($classes);
  }

}
