<?php

/**
 * ValidatorAggregate.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

/**
 * An aggregate of {@link ValidatorInterface} validating a value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ValidatorAggregate extends AbstractValidatorAggregate implements \ArrayAccess {

  /**
   * Checks whether a validator exists in the offset
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   */
  public function offsetExists($offset) {
    return $this->validators->offsetExists($offset);
  }

  /**
   * Checks whether a validator exists in the offset
   * 
   * Shorthand method for {@link self::offsetExists()}
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   * @see    self::offsetExists()
   */
  public function exists($offset) {
    return $this->offsetExists($offset);
  }

  /**
   * Returns the validator object at the specified offset or null if none present
   *
   * @param  mixed $offset the index with the validator
   * @return ValidatorInterface|null the validator object or null
   */
  public function offsetGet($offset) {
    return $this->validators->offsetGet($offset);
  }

  /**
   * Sets a validator object for the input
   * 
   * Shorthand method for {@link self::offsetGet()}
   * 
   * @param  mixed $offset the index pointing to the validator
   * @return self for PHP Method Chaining
   * @see    self::offsetGet()
   */
  public function get($offset) {
    return $this->offsetGet($offset);
  }

  /**
   * Assigns a validator to the specified offset
   * 
   * @param  mixed $offset the offset to assign the validator to
   * @param  ValidatorInterface $validator the validator to set
   * @throws InvalidArgumentException if the $validator type is not {@link ValidatorInterface}
   */
  public function offsetSet($offset, $validator) {
    if (!($validator instanceof ValidatorInterface)) {
      throw new \InvalidArgumentException("Validator must be of type " . ValidatorInterface::class);
    }
    $this->validators->offsetSet($offset, $validator);
  }

  /**
   * Assigns a validator to the specified offset
   *
   * Chainable shorthand method for {@link self::offsetSet()}
   *
   * @param  mixed $offset the offset to assign the validator to
   * @param  ValidatorInterface $validator validator object
   * @return self for PHP Method Chaining
   * @see    self::offsetSet()
   */
  public function set($offset, ValidatorInterface $validator) {
    $this->offsetSet($offset, $validator);
    return $this;
  }

  /**
   * Unsets validator from the offset
   * 
   * @param mixed $offset offset to unset
   */
  public function offsetUnset($offset) {
    $this->validators->offsetUnset($offset);
  }

  /**
   * Unsets validator from the offset
   * 
   * Chainable shorthand method for {@link self::offsetUnset()}
   *
   * @param  mixed $offset offset to unset
   * @return self for PHP Method Chaining
   * @see    self::offsetUnset()
   */
  public function remove($offset) {
    $this->offsetUnset($offset);
    return $this;
  }

}
