<?php

/**
 * AttributeInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

/**
 * Iterface defines an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeInterface {
  
  /**
   * Returns the instance of the object as a string
   *
   * @return string the object as a string
   */
  public function __toString();

  /**
   * Returns the name of the attribute 
   * 
   * @return string the name of the attribute
   */
  public function getName();

  /**
   * Sets the value of the attribute
   *
   * @param    mixed $value value to set
   * @return   self for PHP Method Chaining
   * @throws   InvalidAttributeException if the attribute value is invalid
   * @throws   UnmodifiableAttributeException if the attribute value is unmodifiable
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
   * @return mixed the value of the attribute
   * @throws InvalidAttributeException if the attribute value is invalid
   * @throws UnmodifiableAttributeException if the attribute value is unmodifiable
   */
   public function getValue();

  /**
   * Checks whether the attribute has a locked value or not
   * 
   * @return boolean true if the attribute has a locked value and false otherwise
   */
   public function isLocked();

  /**
   * Locks the given value to the attribute
   *
   * @param  string $value the value to lock to the attribute
   * @return self for PHP Method Chaining
   * @throws   InvalidAttributeException if the attribute value is invalid
   * @throws   UnmodifiableAttributeException if the attribute value is unmodifiable
   */
   public function lock($value);

  /**
   * Removes all non locked values from the attribute
   *
   * @return   self for PHP Method Chaining
   */
   public function clear();

  /**
   * Determines whether the attribute contains the given value
   *
   * @param  mixed $value the value to search for
   * @return boolean true if the given value exists
   */
   public function contains($value);

  /**
   * Sets the attribute as required
   *  
   * **A required attribute cannot be removed** but its value is still mutable.
   * 
   * @return self for PHP Method Chaining
   */
  public function setRequired();

  /**
   * Checks whether the attribute is required or not
   * 
   * **Note:** a required attribute either has locked value or the attribute 
   * name is required.
   *
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isRequired();

  /**
   * Checks whether the attribute is visible or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return boolean true if the attribute is visible and false otherwise
   */
  public function isVisible();

  /**
   * Attaches an observer so that it can be notified of attribute updates
   * 
   * @param  callable|AttributeChangeObserver $observer
   * @return self for PHP Method Chaining
   */
  public function attachAttributeChangeObserver($observer);

  /**
   * Detaches an observer from the subject to no longer notify it of attribute updates
   * 
   * @param  callable|AttributeChangeObserver $observer
   * @return self for PHP Method Chaining
   */
  public function detachAttributeChangeObserver($observer);

  /**
   * Notifies all attached attribute observers
   * 
   * @return self for PHP Method Chaining
   */
  public function notifyChange();

}
