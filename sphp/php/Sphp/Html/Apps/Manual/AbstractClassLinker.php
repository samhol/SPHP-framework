<?php

/**
 * AbstractClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Core\Types\Strings;
use ReflectionClass;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractClassLinker extends AbstractLinker implements PhpClassLinkerInterface {

  /**
   * Class Reflector
   *
   * @var ReflectionClass
   */
  protected $ref;

  /**
   * Constructs a new instance
   *
   * @param string $root the base url pointing to the documentation
   * @param string|\object $class class name or object
   * @param string|null $defaultTarget the default target used in the generated links or `null` for none
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct($root, $class, $defaultTarget = "_blank", $defaultCssClasses = null) {
    parent::__construct($root, $defaultTarget, $defaultCssClasses);
    $this->ref = new ReflectionClass($class);
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->ref);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->ref = new ReflectionClass($this->ref->getName());
    parent::__clone();
  }

  /**
   * {@inheritdoc}
   */
  public function __toString() {
    return "" . $this->getLink();
  }

  /**
   * {@inheritdoc}
   */
  public function hyperlink($relativeUrl = null, $content = null, $title = null) {
    return parent::hyperlink($relativeUrl, str_replace("\\", "\\<wbr>", $content), $title);
  }

  /**
   * {@inheritdoc}
   */
  public function getLink($name = null) {
    if (Strings::isEmpty($name)) {
      $name = $this->ref->getShortName();
    }
    if ($this->ref->isInterface()) {
      $title = $this->ref->getName() . " interface";
    } else if ($this->ref->isTrait()) {
      $title = $this->ref->getName() . " trait";
    } else if ($this->ref->isAbstract()) {
      $title = "abstract " . $this->ref->getName() . " class";
    } else {
      $title = $this->ref->getName() . " class";
    }
    return $this->hyperlink($this->getClassPath(), $name, $title);
  }

  /**
   * {@inheritdoc}
   */
  public function method($method, $full = true) {
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
    return $this->hyperlink($this->getMethodPath($method), $text, $title);
  }

  /**
   * {@inheritdoc}
   */
  public function constant($constName) {
    $name = $this->ref->getShortName() . "::$constName";
    $title = $this->ref->getName() . "::$constName constant";
    return $this->hyperlink($this->getConstantPath($constName), $name, $title);
  }

  /**
   * {@inheritdoc}
   */
  public function namespaceLink($full = true) {
    $name = $this->ref->getNamespaceName();
    $title = "$name namespace";
    return $this->hyperlink($this->getNamespacePath(), $name, $title);
  }

  /**
   * Returns the relative API page path of the given class
   *
   * @return string the relative API page path of the given class
   */
  abstract protected function getClassPath();

  /**
   * Returns the relative API page path of the given class method
   *
   * @param  string $method the method name
   * @return string the relative API page path string pointing to the given class method
   */
  abstract protected function getMethodPath($method);

  /**
   * Returns the relative API page path of the given class constant
   *
   * @param  string $constant the name of the constant
   * @return string the relative API page path of the given class constant
   */
  abstract protected function getConstantPath($constant);

  /**
   * Returns the relative API page path of the given namespace
   *
   * @return string the relative API page path of the given namespace
   */
  abstract protected function getNamespacePath();
}
