<?php

/**
 * AbstractClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use ReflectionClass;

/**
 * Hyperlink object generator pointing to an exising API documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @link    http://www.apigen.org/ ApiGen
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractClassLinker extends AbstractLinker implements ClassLinkerInterface {

  /**
   * class reflector
   *
   * @var ReflectionClass
   */
  protected $ref;

  /**
   * Constructs a new instance
   *
   * @param string|\object $class class name or object
   * @param string $root the base url pointing to the documentation
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct($class, ApiUrlGeneratorInterface $pathParser, $defaultTarget = null, $defaultCssClasses = null) {
    parent::__construct($pathParser, $defaultTarget, $defaultCssClasses);
    $this->ref = new ReflectionClass($class);
  }

  public function __destruct() {
    unset($this->ref);
    parent::__destruct();
  }

  public function __clone() {
    $this->ref = new ReflectionClass($this->ref->getName());
    parent::__clone();
  }

  public function __toString() {
    return $this->getLink()->getHtml();
  }

  public function hyperlink($url = null, $content = null, $title = null) {
    return parent::hyperlink($url, str_replace("\\", "\\<wbr>", $content), $title);
  }

  public function getLink($name = null) {
    if ($name === null) {
      $name = $this->ref->getShortName();
    }
    $longName = $this->ref->getName();
    if ($this->ref->isInterface()) {
      $title = "Interface $longName";
    } else if ($this->ref->isTrait()) {
      $title = "Trait $longName";
    } else if ($this->ref->isAbstract()) {
      $title = "Abstract class $longName";
    } else {
      $title = "Class $longName";
    }
    return $this->hyperlink($this->urls()->getClassUrl($longName), $name, $title);
  }

  public function methodLink($method, $full = true) {
    $this->ref->getMethod($method);
    $reflectedMethod = $this->ref->getMethod($method);
    if ($full) {
      $text = $this->ref->getShortName() . "::$reflectedMethod->name()";
    } else {
      $text = "$reflectedMethod->name()";
    }
    $fullClassName = $this->ref->getName();
    if ($reflectedMethod->isConstructor()) {
      //$name = $prefix . "$reflectedMethod->name()";
      $title = "The $fullClassName constructor";
    } else if ($reflectedMethod->isStatic()) {
      //$name = $this->ref->getShortName() . "::$reflectedMethod->name()";
      $title = "Static method: $fullClassName::$reflectedMethod->name()";
    } else {
      //$name = $this->ref->getShortName() . "::$reflectedMethod->name()";
      $title = "Instance method: $fullClassName::$reflectedMethod->name()";
    }
    return $this->hyperlink($this->urls()->getClassMethodUrl($fullClassName, $method), $text, $title);
  }

  public function constantLink($constName) {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    return $this->hyperlink($this->urls()->getClassConstantUrl($this->ref->getName(), $constName), $name, $title);
  }

  public function namespaceLink($full = true) {
    $name = $this->ref->getNamespaceName();
    $title = "$name namespace";
    return $this->hyperlink($this->urls()->getNamespaceUrl($name), $name, $title);
  }

}
