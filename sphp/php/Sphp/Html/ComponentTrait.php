<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\Attributes\PropertyCollectionAttribute;

/**
 * Trait implements functionality of a Component Interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait ComponentTrait {

  use CssClassifiableTrait;

  /**
   * Returns the attribute manager attached to the component
   *
   * @return AttributeContainer the attribute manager
   */
  abstract public function attributes(): AttributeContainer;

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  bool $forceNewValue whether a new id value is created or not
   * @return string 
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(bool $forceNewValue = false): string {
    return $this->attributes()->id()->identify($forceNewValue);
  }

  /**
   * Identifies the element with an unique id attribute.
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is 
   * checked for its uniqueness.
   * 
   * @param  mixed $id the value of the id attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function setId(string $id): string {
    $this->attributes()->setAttribute('id', $id);
    return $this;
  }

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the class attribute object
   */
  public function cssClasses(): ClassAttribute {
    return $this->attributes()->classes();
  }

  /**
   * Returns the attribute object containing inline styles
   *
   * @return PropertyCollectionAttribute the attribute object containing inline styles
   */
  public function css(): PropertyCollectionAttribute {
    return $this->attributes()->styles();
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
   * @param  string $name the name of the attribute
   * @param  mixed $value the value of the attribute
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the attribute name or value is invalid
   * @throws UnmodifiableAttributeException if the attribute value is unmodifiable
   */
  public function setAttribute(string $name, $value = true) {
    $this->attributes()->setAttribute($name, $value);
    return $this;
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   */
  public function removeAttribute(string $name) {
    $this->attributes()->remove($name);
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
  public function getAttribute(string $name) {
    return $this->attributes()->getValue($name);
  }

  /**
   * Checks if an attribute exists
   *
   * @param  string $name the name of the attribute
   * @return boolean (attribute exists)
   */
  public function attributeExists(string $name): bool {
    return $this->attributes()->isVisible($name);
  }

}
