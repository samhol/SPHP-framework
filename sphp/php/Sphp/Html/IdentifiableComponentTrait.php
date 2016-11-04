<?php

/**
 * IdentifiableComponentTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;
use Sphp\Html\Attributes\PropertyAttribute as PropertyAttribute;

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
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Returns the class attribute object
   *
   * @return MultiValueAttribute the class attribute object
   */
  public function cssClasses() {
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
   * Sets the specified CSS class names removing old non locked ones
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string paramater can contain multiple comma separated CSS class names
   * 2. An array paramater can contain only one CSS class name per value
   * 3. Duplicate CSS class names are not stored
   *
   * @param  string|string[] $cssClasses CSS class names to set
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function setCssClass($cssClasses) {
    $this->cssClasses()->set($cssClasses);
    return $this;
  }

  /**
   * Adds the specified CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string paramater can contain multiple space separated CSS class names
   * 2. An array paramater can contain only one CSS class name per value
   * 3. Duplicate CSS class names are not stored
   *
   * @param  string|string[] $cssClasses CSS class names to add
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass($cssClasses) {
    $this->cssClasses()->add($cssClasses);
    return $this;
  }

  /**
   * Checks whether the given CSS class(es) are locked
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string paramater can contain multiple comma separated CSS class names
   * 2. An array paramater can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to check
   * @return boolean true if the attribute has a locked value on it and false otherwise
   */
  public function cssClassLocked($cssClasses) {
    return $this->cssClasses()->isLocked($cssClasses);
  }

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string paramater can contain multiple comma separated CSS class names
   * 2. An array paramater can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to remove
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass($cssClasses) {
    $this->cssClasses()->remove($cssClasses);
    return $this;
  }

  /**
   * Removes all non locked CSS class names
   *
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function clearCssClasses() {
    $this->cssClasses()->clear();
    return $this;
  }

  /**
   * Determines whether the given CSS class names exists
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string paramater can contain multiple comma separated CSS class names
   * 2. An array paramater can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to search for
   * @return boolean true if the given CSS class names exists
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass($cssClasses) {
    return $this->cssClasses()->contains($cssClasses);
  }

  /**
   * Sets an inline style definition using HTML elements style attribute
   *
   * **Note:** Old inline property is replaced if the property names are equal.
   *
   * @param  string $property CSS property
   * @param  string $value CSS value
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_style.asp style attribute
   */
  public function setStyle($property, $value) {
    $this->inlineStyles()->setProperty($property, $value);
    return $this;
  }

  /**
   * Sets inline style definitions using HTML elements style attribute
   *
   * **Notes:**
   *
   * * Old inline properties are replaced if the new property name is equal.
   * * Styles are defined as "property" => "value" pairs in the <var>$styles</var> array.
   *
   * @param  string[] $styles CSS property and CSS value pairs
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_style.asp style attribute
   */
  public function setStyles(array $styles) {
    $this->inlineStyles()->setProperties($styles);
    return $this;
  }

  /**
   * Removes the given inline style property
   *
   * @param  string $property CSS property name
   * @return self for PHP Method Chaining
   */
  public function removeStyle($property) {
    $this->inlineStyles()->unsetProperty($property);
    return $this;
  }

  /**
   * Removes all inline style definitions
   *
   * @return self for PHP Method Chaining
   */
  public function clearStyles() {
    $this->inlineStyles()->clear();
    return $this;
  }

  /**
   * Determines whether the given CSS property exists
   *
   * @param  string $property CSS property name
   * @return boolean true if the style attribute exists and false otherwise
   */
  public function hasStyle($property) {
    return $this->inlineStyles()->hasProperty($property);
  }

  /**
   * Returns the value of the CSS property name or null if the property does
   *  not exist
   *
   * @param  string $property CSS property name
   * @return string|null the value of the style attribute or null
   */
  public function getStyleValue($property) {
    return $this->inlineStyles()->getProperty($property);
  }

  /**
   * Sets multiple attribute name value pairs
   *
   * For each `$attr => $value` pairs the method calls the {@link self::setAttr()} method
   *
   * @param    mixed[] $attrs an array of attribute name value pairs
   * @return self for PHP Method Chaining
   * @throws   InvalidAttributeException if any of the attributes is invalid
   * @throws   UnmodifiableAttributeException if the value of the attribute is already locked
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
  public function setAttr($name, $value = null) {
    $this->attrs()->set($name, $value);
    return $this;
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return self for PHP Method Chaining
   */
  public function removeAttr($name) {
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
  public function getAttr($name) {
    return $this->attrs()->get($name);
  }

  /**
   * Checks if an attribute exists
   *
   * @param  string $name the name of the attribute
   * @return boolean (atribute exists)
   */
  public function attrExists($name) {
    return $this->attrs()->exists($name);
  }

  public function identify($identityName = "id", $prefix = "id_", $length = 16) {
    return $this->attrs()->identify($identityName, $prefix, $length);
  }

  public function hasId($identityName = "id") {
    return $this->attrs()->hasId($identityName);
  }

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $title the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setTitle($title) {
    return $this->setAttr("title", $title);
  }

  /**
   * Hides the component from the document
   *
   * **Note:**
   *
   * The element will not be displayed at all (has no effect on layout). Adds
   * an inline style property <var>display: hidden;</var> to the component.
   *
   * @return self for PHP Method Chaining
   */
  public function hide() {
    $this->setStyle("display", "none");
    return $this;
  }

  /**
   * Unhides the component (Removes the inline hiding property)
   *
   * **Notes:**
   *
   *  Removes only inline style property <var>display: hidden;</var> . The component
   *  might still be defined as hidden in CSS style sheets or by a JavaScript command.
   *
   * @return self for PHP Method Chaining
   */
  public function unhide() {
    if ($this->inlineStyles()->getProperty("display") == "none") {
      $this->removeStyle("display");
    }
    return $this;
  }

}
