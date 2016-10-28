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
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty();

  /**
   * Clears the contents
   *
   * @return self for PHP Method Chaining
   */
  public function clear();

  /**
   * Checks whether a value exists
   *
   * @param  mixed $value the value to search for
   * @return boolean `true` on success or `false` on failure
   */
  public function exists($value);

  /**
   * Removes all instances of the given value
   *
   * @param  mixed $value the value to remove
   * @return self for PHP Method Chaining
   */
  public function remove($value);
}
