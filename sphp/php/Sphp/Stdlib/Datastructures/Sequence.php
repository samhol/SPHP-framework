<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Iterator;
use Sphp\Exceptions\OutOfBoundsException;

/**
 * An implementation of a sequence of values
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-03-06
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Sequence implements Iterator {

  /**
   * stored individual values
   *
   * @var array
   */
  private $sequence = [];

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->sequence);
  }

  /**
   * 
   * @param  int $position
   * @return boolean
   */
  protected function isValidPosition(int $position): bool {
    $test = $position + 1;
    return $this->minLength <= $test && ($this->maxLength === null || $this->maxLength >= $test);
  }

  /**
   * Inserts values at a given index
   *
   * @param int $index the index at which to insert
   * @param  mixed $values
   * @return $this for a fluent interface
   * @throws OutOfBoundsException
   */
  public function insert(int $index, $values) {
    if ($index < 0) {
      throw new OutOfBoundsException("Indec ($index) mest be zero or positive integer");
    }
    $this->sequence[$index] = $values;
    ksort($this->sequence);
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * @param  mixed,... $value the value(s) to push
   * @return $this for a fluent interface
   */
  public function push(...$value) {
    foreach ($value as $val) {
      $this->sequence[] = $val;
    }
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * @param  array $values an array of values to push
   * @return $this for a fluent interface
   */
  public function pushFromArray(array $values) {
    foreach ($values as $val) {
      $this->sequence[] = $val;
    }
    return $this;
  }

  /**
   * Removes and returns a value by index
   * 
   * @param  int $index the index
   * @return mixed the removed value
   * @throws OutOfRangeException if the index is not valid.
   */
  public function remove(int $index) {
    if ($this->exists($index)) {
      throw new OutOfRangeException("Index ($index) is not valid");
    }
    $value = $this->sequence[$index];
    unset($this->sequence[$index]);
    return $value;
  }

  public function clear() {
    $this->sequence = [];
    return $this;
  }

  /**
   * Removes and returns the last value
   * 
   * @return mixed the removed last value
   * @throws UnderflowException if empty
   */
  public function pop() {
    if ($this->isEmpty()) {
      throw new UnderflowException("Sequence is empty");
    }
    return array_pop($this->sequence);
  }

  /**
   * Determine if the queue is empty or not
   *
   * @return boolean true if the queue is empty, false otherwise
   */
  public function isEmpty(): bool {
    return empty($this->sequence);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  int $index the index
   * @return boolean true if the property exists and false otherwise
   */
  public function exists(int $index): bool {
    return isset($this->sequence[$index]) || array_key_exists($index, $this->sequence);
  }

  /**
   * Determines whether the given atomic values exists
   *
   * @param  mixed,... $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function contains(...$values): bool {
    $exists = false;
    foreach ($values as $needle) {
      $exists = in_array($needle, $this->sequence);
      if (!$exists) {
        break;
      }
    }
    return $exists;
  }

  /**
   * Counts the number of the atomic values stored in the attribute
   *
   * @return int the number of the atomic values stored in the attribute
   */
  public function count(): int {
    return count($this->sequence);
  }

  public function toArray(): array {
    return $this->sequence;
  }

  /**
   * Joins all values together as a string
   * 
   * @param  string|null $glue an optional string to separate each value
   * @return string All values of the sequence joined together as a string
   */
  public function join(string $glue = null): string {
    if ($glue === null) {
      return implode($this->sequence);
    } else {
      return implode($glue, $this->sequence);
    }
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->sequence);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->sequence);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->sequence);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->sequence);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->sequence);
  }

}
