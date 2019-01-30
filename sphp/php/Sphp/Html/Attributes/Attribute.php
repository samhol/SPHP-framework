<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Attribute {

  /**
   * Returns the instance of the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string;

  /**
   * Returns the name of the attribute 
   * 
   * @return string the name of the attribute
   */
  public function getName(): string;

  /**
   * Sets the value of the attribute
   *
   * @param  mixed $value value to set
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function setValue($value);

  /**
   * Checks whether the attribute has a locked value or not
   * 
   * @return boolean true if the attribute has a locked value and false otherwise
   */
  public function isProtected(): bool;

  /**
   * Protects the given value to the attribute
   *
   * @param  scalar $value the value to lock to the attribute
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function protectValue($value);

  /**
   * Returns the value of the attribute
   * 
   * **IMPORTANT:**
   * 
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   * 
   * @return bool|int|float|string the value of the attribute
   */
  public function getValue();

  /**
   * Checks whether the attribute is visible or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return boolean true if the attribute is visible and false otherwise
   */
  public function isVisible(): bool;

  /**
   * Checks whether the attribute is empty or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return boolean true if the attribute is empty and false otherwise
   */
  public function isEmpty(): bool;

  /**
   * Sets the attribute as required
   *  
   * **A required attribute cannot be removed** but its value is still mutable.
   * 
   * @return $this for a fluent interface
   */
  public function forceVisibility();

  /**
   * Checks whether the attribute is required or not
   * 
   * **Note:** a required attribute either has locked value or the attribute 
   * name is required.
   *
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isDemanded(): bool;

  /**
   * Clears all unprotected values
   *
   * @return $this for a fluent interface
   */
  public function clear();
}
