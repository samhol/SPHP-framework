<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use ArrayAccess;
use Countable;
use Traversable;

/**
 * Defines a general purpose collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.php.net/manual/en/arrayobject.php The ArrayObject class
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface CollectionInterface extends Arrayable, ArrayAccess, Countable, Traversable {

  /**
   * Appends a new value as the last element
   *
   * @postcondition contains($value) === true
   * @param  mixed $value element
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  public function prepend($value);

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty(): bool;

  /**
   * Clears the contents
   *
   * @postcondition isEmpty() === true
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  public function remove($value);
}
