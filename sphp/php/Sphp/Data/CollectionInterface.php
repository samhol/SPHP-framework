<?php

/**
 * SphpArrayObjectInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use ArrayAccess;
use Countable;
use IteratorAggregate;

/**
 * Interface extends some native PHP datastructure interfaces
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-24
 * @link    http://www.php.net/manual/en/arrayobject.append.php The ArrayObject class
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CollectionInterface extends Arrayable, ArrayAccess, Countable, IteratorAggregate {

  /**
   * Appends a new value as the last element
   *
   * @param  mixed $value element
   * @return self for PHP Method Chaining
   */
  public function append($value);

  /**
   * Prepends a new value as the first element
   *
   * * The numeric keys of the content will be renumbered starting from zero
   *   and the index of the prepended value is 'int(0)'
   *
   * @param  mixed $value the value being prepended
   * @return self for PHP Method Chaining
   */
  public function prepend($value);

  /**
   * Clears the contents
   *
   * @return self for PHP Method Chaining
   */
  public function clear();

  /**
   * Checks whether an offset exists
   *
   * Shorthand method for {@link \ArrayAccess::offsetExists()} implementation
   *
   * @param  mixed $offset an offset to check for
   * @return boolean `true` on success or `false` on failure
   * @uses   self::offsetExists()
   */
  public function exists($offset);

  /**
   * Returns the value at specified offset
   *
   * Shorthand method for {@link \ArrayAccess::offsetGet()} implementation
   *
   * @param  mixed $offset the index with the content element
   * @return mixed content or `null`
   * @uses   self::offsetGet()
   */
  public function get($offset);

  /**
   * Assigns a value to the specified offset
   *
   * Chainable shorthand method for {@link \ArrayAccess::offsetSet()} implementation
   *
   * @param  mixed $offset the offset to assign the value to
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   * @uses   self::offsetSet()
   */
  public function set($offset, $value);

  /**
   * Unsets an offset
   *
   * Chainable shorthand method for {@link \ArrayAccess::offsetUnset()} implementation
   *
   * @param  mixed $offset offset to unset
   * @return self for PHP Method Chaining
   * @uses   self::offsetUnset()
   */
  public function remove($offset);
}
