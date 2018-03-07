<?php

/**
 * Sequence.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

use Iterator;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\OutOfBoundsException;

/**
 * An implementation of a sequence of values
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-03-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A `string` parameter can contain multiple comma separated atomic values
   * 2. An `array` parameter can contain only one atomic value per array value
   * 3. Any numeric value is treated as a string value
   * 4. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[] $values the values to set
   * @return $this for a fluent interface
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
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
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
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  array. $values an array of values to push
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

  public function pop() {
    if ($this->exists($index)) {
      throw new OutOfRangeException("Index ($index) is not valid");
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
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   *
   * @param  scalar|scalar[] $values the atomic values to search for
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

  public function join(string $glue = ','): string {
    return implode($glue, $this->sequence);
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
