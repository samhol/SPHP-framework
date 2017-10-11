<?php

/**
 * IdentifiableComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyAttribute;

/**
 * Trait implements functionality of the {@link ComponentInterface} and {@link IdentifiableInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait IdentifiableComponentTrait {

  use ContentTrait;

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the class attribute object
   */
  public function cssClasses(): ClassAttribute {
    return $this->attrs()->classes();
  }

  /**
   * Returns the attribute object containing inline styles
   *
   * @return PropertyAttribute the attribute object containing inline styles
   */
  public function inlineStyles() {
    return $this->attrs()->styles();
  }

  /**
   * Adds the specified CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple space separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   * 3. Duplicate CSS class names are not stored
   *
   * @param  string|string[] $cssClasses CSS class names to add
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass($cssClasses) {
    $this->cssClasses()->add(func_get_args());
    return $this;
  }

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to remove
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass($cssClasses) {
    $this->cssClasses()->remove(func_get_args());
    return $this;
  }

  /**
   * Determines whether the given CSS class names exists
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to search for
   * @return boolean true if the given CSS class names exists
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass($cssClasses): bool {
    return $this->cssClasses()->contains(func_get_args());
  }

  /**
   * Sets multiple attribute name value pairs
   *
   * For each `$attr => $value` pairs the method calls the {@link self::setAttr()} method
   *
   * @param  mixed[] $attrs an array of attribute name value pairs
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if any of the attributes is invalid
   * @throws UnmodifiableAttributeException if the value of the attribute is already locked
   */
  public function setAttrs(array $attrs = []) {
    foreach ($attrs as $name => $value) {
      $this->attrs()->set($name, $value);
    }
    return $this;
  }

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   * 1. For 'class' attribute: if a CSS class name is locked the method does nothing
   * 2. For any other locked attribute the method throws a {@link LockingException}
   *
   * **`$value` handling:**
   *
   * 1. the type of the value should always convert to string
   * 2. `null` or an empty `string`: an empty attribute is set
   * 3. boolean `true`: an empty attribute is set
   * 4. boolean `false`: attribute is removed if present
   * 5. otherwise the attribute value the string conversion value
   *
   * @param    string $name the name of the attribute
   * @param    mixed $value the value of the attribute
   * @return   self for PHP Method Chaining
   * @throws   InvalidAttributeException if the attribute name or value is invalid
   * @throws   UnmodifiableAttributeException if the attribute value is unmodifiable
   */
  public function setAttr(string $name, $value = null) {
    $this->attrs()->set($name, $value);
    return $this;
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   */
  public function removeAttr(string $name) {
    $this->attrs()->remove($name);
    return $this;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return mixed the value of the attribute
   */
  public function getAttr(string $name) {
    return $this->attrs()->getValue($name);
  }

  /**
   * Checks if an attribute exists
   *
   * @param  string $name the name of the attribute
   * @return boolean (attribute exists)
   */
  public function attrExists(string $name): bool {
    return $this->attrs()->exists($name);
  }

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  string $prefix optional prefix of the identity value
   * @param  int $length the length of the identity value
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(string $prefix = 'id_', int $length = 16): string {
    return $this->attrs()->identify($prefix, $length);
  }

  /**
   * Checks whether the identifying attribute is set or not
   *
   * @return boolean true if the identity is set, otherwise false
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function hasId(): bool {
    return $this->attrs()->hasId();
  }

}
