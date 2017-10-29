<?php

/**
 * AttributeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Defines an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeInterface {

  /**
   * Returns the instance of the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string;

  /**
   * Returns the instance of the object as a string
   *
   * @return string the object as a string
   */
  public function getHtml(): string;

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
   * @throws AttributeException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function set($value);

  /**
   * Returns the value of the attribute
   * 
   * **IMPORTANT:**
   * 
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   * 
   * @return scalar the value of the attribute
   */
  public function getValue();

  /**
   * Checks whether the attribute has a locked value or not
   * 
   * @return boolean true if the attribute has a locked value and false otherwise
   */
  public function isProtected(): bool;

  /**
   * Locks the given value to the attribute
   *
   * @param  scalar $value the value to lock to the attribute
   * @return $this for a fluent interface
   * @throws AttributeException if the attribute value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function protect($value);

  /**
   * Removes all non locked values from the attribute
   *
   * @return $this for PHP Method Chaining
   */
  public function clear();

  /**
   * Sets the attribute as required
   *  
   * **A required attribute cannot be removed** but its value is still mutable.
   * 
   * @return $this for a fluent interface
   */
  public function demand();

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
}
