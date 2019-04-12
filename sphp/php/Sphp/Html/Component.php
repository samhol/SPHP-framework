<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Attributes\PropertyCollectionAttribute;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines the basic functionality of any HTML component
 *
 * This models an actual HTML component and supports HTML attribute manipulation.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Component extends IdentifiableContent, CssClassifiableContent {

  /**
   * Returns the attribute manager attached to the component
   * 
   * @return HtmlAttributeManager the attribute manager
   */
  public function attributes(): HtmlAttributeManager;

  /**
   * Returns the attribute object containing inline styles
   * 
   * @return PropertyCollectionAttribute the attribute object containing inline styles
   */
  public function inlineStyles(): PropertyCollectionAttribute;

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
  public function setAttribute(string $name, $value = true);

  /**
   * Removes given attribute if it is not locked
   *
   * @param  string $attrName the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function removeAttribute(string $attrName);

  /**
   * Returns the value of a given attribute name or an empty string if attribute is not set
   *
   * @param  string $attrName the name of the attribute
   * @return mixed the value of the attribute
   */
  public function getAttribute(string $attrName);

  /**
   * Checks if an attribute exists
   *
   * @param  string $attrName the name of the attribute
   * @return boolean (attribute exists)
   */
  public function attributeExists(string $attrName): bool;
}



