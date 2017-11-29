<?php

/**
 * ComponentInterface.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\PropertyAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines the basic functionality of any HTML component
 *
 * This models an actual HTML component and supports HTML attribute manipulation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ComponentInterface extends IdentifiableContent, CssClassifiableContent {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  public function attrs(): HtmlAttributeManager;

  /**
   * Returns the attribute object containing inline styles
   * 
   * @return PropertyAttribute the attribute object containing inline styles
   */
  public function inlineStyles(): PropertyAttribute;

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
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the attribute name or value is invalid
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function setAttr(string $name, $value = null);

  /**
   * Removes given attribute if it is not locked
   *
   * @param  string $attrName the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function removeAttr(string $attrName);

  /**
   * Returns the value of a given attribute name or an empty string if attribute is not set
   *
   * @param  string $attrName the name of the attribute
   * @return string the value of the attribute
   */
  public function getAttr(string $attrName);

  /**
   * Checks if an attribute exists
   *
   * @param  string $attrName the name of the attribute
   * @return boolean (attribute exists)
   */
  public function attrExists(string $attrName): bool;
}



