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
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Hyperlink object generator pointing to an existing API documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicClassLinker implements ClassLinker {

  /**
   * class reflector
   *
   * @var ReflectionClass
   */
  protected $ref;

  /**
   * @var ClassUrlGenerator
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
   * @param ClassUrlGenerator $pathParser
   */
  public function __construct(string $class, ClassUrlGenerator $pathParser) {
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

  /**
   * Returns a hyperlink object pointing to the API documentation of the given property or method
   * 
   * @param  string $name
   * @return A
   * @throws BadMethodCallException
   */
  public function __get(string $name): A {
    try {
      return $this->methodLink($name);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("$name in not valid method for " . $this->ref->getName(), 0, $ex);
    }
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the given property or method
   * 
   * @param  string $name
   * @return A
   * @throws BadMethodCallException
   */
  public function __invoke(string $name): A {
    try {
      return $this->methodLink($name);
    } catch (\Exception $ex) {
      throw new BadMethodCallException("$name in not valid method for " . $this->ref->getName(), 0, $ex);
    }
  }

  /**
   * Returns the name of the class being linked 
   * 
   * @return string the name of the class being linked 
   */
  public function getClassName(): string {
    return $this->ref->getName();
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

  public function urls(): ClassUrlGenerator {
    return $this->classUrlGenerator;
  }

  protected function buildHyperlink(string $url, string $content, string $title): A {
    $a = new A($url, str_replace("\\", "\\<wbr>", $content));
    $a->setAttribute('title', $title);
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
    } catch (\ReflectionException $ex) {
      $hasStatic = $this->ref->hasMethod('__callStatic');
      $hasInstance = $this->ref->hasMethod('__call');
      if ($hasStatic && $hasInstance) {
        $title = "Magic method: $fullClassName::$method()";
        $classes[] = 'magic-method';
      } else if ($hasStatic) {
        $title = "Magic static method: $fullClassName::$method()";
        $classes[] = 'magic-static-method';
      } else if ($hasInstance) {
        $title = "Magic instance method: $fullClassName::$method()";
        $classes[] = 'magic-instance-method';
      } else {
        throw new InvalidArgumentException($ex->getMessage(), 0, $ex);
      }
    }
    return $this->buildHyperlink($this->urls()->getClassMethodUrl($fullClassName, $method), $text, $title)->addCssClass($classes);
  }

  public function constantLink(string $constName): A {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    $classes = ['php-class', 'constant'];
    return $this->buildHyperlink($this->urls()->getClassConstantUrl($this->ref->getName(), $constName), $name, $title)->addCssClass($classes);
  }

  public function namespaceLink(string $linkContent = null): A {
    $fullName = $this->ref->getNamespaceName();
    if ($linkContent !== null) {
      $name = $linkContent;
    } else {
      $name = $fullName;
    }
    $title = "$fullName namespace";
    $classes = ['php-class', 'namespace'];
    return $this->buildHyperlink($this->urls()->getNamespaceUrl($fullName), $name, $title)->addCssClass($classes);
  }

  public function shortNamespaceLink(): A {
    $fullName = $this->ref->getNamespaceName();
    $namespaceArray = explode('\\', $fullName);
    $name = array_pop($namespaceArray);
    $title = "$fullName namespace";
    $classes = ['php-class', 'namespace'];
    return $this->buildHyperlink($this->urls()->getNamespaceUrl($fullName), $name, $title)->addCssClass($classes);
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return BreadCrumbs new instance
   */
  public function classBreadGrumbs(): BreadCrumbs {
    $namespace = $this->ref->getNamespaceName();
    $namespaceArray = explode('\\', $namespace);
    $breadCrumbs = new BreadCrumbs();
    $breadCrumbs->addCssClass('sami', 'class');
    $currentNamespace = [];
    foreach ($namespaceArray as $name) {
      $currentNamespace[] = $name;
      $path = implode("/", $currentNamespace);
      $bc = new BreadCrumb($this->urls()->getNamespaceUrl($path), $name);
      $breadCrumbs->append($bc);
    }
    $breadCrumbs->appendLink($this->urls()->getClassUrl($this->ref->getName()), $this->ref->getShortName());
    return $breadCrumbs;
  }

}
