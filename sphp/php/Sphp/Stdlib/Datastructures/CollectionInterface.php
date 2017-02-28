<?php

/**
 * CollectionInterface.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

use ArrayAccess;
use Countable;
use Traversable;

/**
 * Defines a general purpose collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-24
 * @link    http://www.php.net/manual/en/arrayobject.php The ArrayObject class
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface CollectionInterface extends Arrayable, ArrayAccess, Countable, Traversable {

  /**
   * Appends a new value as the last element
   *
   * @postcondition contains($value) === true
   * @param  mixed $value element
   * @return self for a fluent interface
   */
  public function append($value);

  /**
   * Prepends a new value as the first element
   *
   * * The numeric keys of the content will be renumbered starting from zero
   *   and the index of the prepended value is 'int(0)'
   *
   * @postcondition contains($value) === true
   * @param  mixed $value the value being prepended
   * @return self for a fluent interface
   */
  public function prepend($value);

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty();

  /**
   * Clears the contents
   *
   * @postcondition isEmpty() === true
   * @return self for a fluent interface
   */
  public function clear();

  /**
   * Checks whether a value exists in the collection
   *
   * @param  mixed $value the value to search for
   * @return boolean `true` on success or `false` on failure
   */
  public function contains($value);

  /**
   * Removes all instances of the given value
   *
   * @postcondition contains($value) === false
   * @param  mixed $value the value to remove
   * @return self for a fluent interface
   */
  public function remove($value);
}
