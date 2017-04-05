<?php

/**
 * ComponentInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeManager;
use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\PropertyAttribute;
use Sphp\Html\Attributes\AttributeException;

/**
 * Defines the basic functionality of any HTML component
 *
 * This models an actual HTML component and supports HTML attribute manipulation.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ComponentInterface extends IdentifiableInterface, ContentInterface {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return AttributeManager the attribute manager
   */
  public function attrs();

  /**
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  public function cssClasses();

  /**
   * Returns the attribute object containing inline styles
   * 
   * @return PropertyAttribute the attribute object containing inline styles
   */
  public function inlineStyles();

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
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass($cssClasses);

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   * 
   * @param  string|string[] $cssClasses CSS class names to remove
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass($cssClasses);

  /**
   * Determines whether the given CSS class names are stored into the manager
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string|string[] $cssClasses CSS class names to search for
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass($cssClasses);

  /**
   * Sets an inline style definition using HTML elements style attribute
   *
   * **Note:** Old inline property is replaced if the property names are equal.
   *
   * @param  string $property CSS property
   * @param  string $value CSS value
   * @return self for a fluent interface
   * @throws AttributeException if the property value is already locked
   * @throws InvalidArgumentException if either the name or the value of the property is empty
   * @link   http://www.w3schools.com/tags/att_global_style.asp style attribute
   */
  public function setStyle($property, $value);

  /**
   * Stores multiple inline style property value pairs
   *
   * **Notes:**
   * 
   * * Styles are defined as "property" => "value" pairs in the <var>$styles</var> array.
   * * Old inline properties are replaced if the new property name is equal.
   * 
   * @param  string[] $styles CSS property and CSS value pairs
   * @return self for a fluent interface
   * @throws AttributeException if any of the properties is already locked
   * @throws InvalidArgumentException if if any of the properties has empty name or value
   * @link   http://www.w3schools.com/tags/att_global_style.asp style attribute
   */
  public function setStyles(array $styles);

  /**
   * Removes given removable inline style property
   *
   * @param  string $property CSS property
   * @return self for a fluent interface
   * @throws AttributeException if the property is unmodifiable
   */
  public function removeStyle($property);

  /**
   * Removes all inline style definitions
   *
   * @return self for a fluent interface
   */
  public function clearStyles();

  /**
   * Determines whether the given CSS property exists
   *
   * @param  string $property CSS property
   * @return boolean true if the style attribute exists and false otherwise
   */
  public function hasStyle($property);

  /**
   * Returns the value of the style attribute or null if the style attribute
   * does not exist
   *
   * @param  string $property CSS property name
   * @return string|null the value of the style attribute or null
   */
  public function getStyleValue($property);

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   * 1. For 'class' attribute: if a CSS class name is locked the method does nothing
   * 2. For any other locked attribute the method throws a {@link UnmodifiableAttributeException}
   *
   * `$value` parameter:
   *
   * 1. the type of the value should always convert to string
   * 2. `null` or an empty `string`: an empty attribute is set
   * 3. boolean `true`: an empty attribute is set
   * 4. boolean `false`: attribute is removed
   * 5. otherwise the attribute value is the string conversion value
   *
   * @param  string $name the name of the attribute
   * @param  mixed $value the value of the attribute
   * @return self for a fluent interface
   * @throws InvalidArgumentException if the attribute name or value is invalid
   * @throws AttributeException if the attribute value is unmodifiable
   */
  public function setAttr($name, $value = null);

  /**
   * Removes given attribute if it is not locked
   *
   * @param  string $attrName attribute's name
   * @return self for a fluent interface
   */
  public function removeAttr($attrName);

  /**
   * Returns the value of a given attribute name or an empty string if attribute is not set
   *
   * @param  string $attrName attribute's name
   * @return string attribute's value
   */
  public function getAttr($attrName);

  /**
   * Checks if an attribute exists
   *
   * @param  string $attrName attribute's name
   * @return boolean (atribute exists)
   */
  public function attrExists($attrName);
}
