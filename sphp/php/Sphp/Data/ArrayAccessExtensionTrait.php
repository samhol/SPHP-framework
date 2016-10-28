<?php

/**
 * ArrayAccessExtensionTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

/**
 * Trait implements chainable shorthand methods to {@link \ArrayAccess} implementor
 *
 * **Implemented shorthand methods:**
 * 
 * 1. {@link self::exists()}: {@link \ArrayAccess::offsetExists()}
 * 2. {@link self::get()}: {@link \ArrayAccess::offsetGet()}
 * 3. {@link self::set()}: {@link \ArrayAccess::offsetSet()}
 * 4. {@link self::remove()}: {@link \ArrayAccess::offsetUnset()}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ArrayAccessExtensionTrait {

  /**
   * Determines whether the given property exists
   *
   * @param  mixed $offset the offset key
   * @return boolean true if the property exists and false otherwise
   */
  abstract public function offsetExists($offset);

  /**
   * Returns an item at a given offset
   *
   * @postcondition Returns null when the offset does not exist.
   * @param  mixed $offset the offset key
   * @return string|null the value of the property or null
   */
  abstract public function offsetGet($offset);

  /**
   * Sets the item at a given offset
   *
   * @param  mixed $offset the offset key
   * @param  mixed $value the value to set
   */
  abstract public function offsetSet($offset, $value);

  /**
   * Unset the item at a given offset
   *
   * @param  mixed $offset the offset key
   */
  abstract public function offsetUnset($offset);

  /**
   * Checks whether an offset exists
   * 
   * Shorthand method for {@link \ArrayAccess::offsetExists()} implementation
   *
   * @param  mixed $offset an offset to check for
   * @return boolean true on success or false on failure
   * @uses   \ArrayAccess::offsetExists()
   */
  public function exists($offset) {
    return $this->offsetExists($offset);
  }

  /**
   * Returns the value at specified offset
   * 
   * Shorthand method for {@link \ArrayAccess::offsetGet()} implementation
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content or `null`
   * @uses   \ArrayAccess::offsetGet()
   */
  public function get($offset) {
    return $this->offsetGet($offset);
  }

  /**
   * Appends a new value as the last element
   *
   * @param  mixed $value $value the value being pushed (appended)
   * @return self for PHP Method Chaining
   */
  public function append($value) {
    $this->offsetSet(null, $value);
    return $this;
  }

}
