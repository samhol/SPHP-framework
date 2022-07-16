<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use IteratorAggregate;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\UnderflowException;

/**
 * Implements a Vector
 * 
 * A Vector is a sequence of values in a contiguous buffer that grows and 
 * shrinks automatically
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Vector implements IteratorAggregate {

  /**
   * stored individual values 
   */
  private array $sequence;
  private int $capacity;

  /**
   * Constructor
   *  
   * @param mixed ... $values
   */
  public function __construct(mixed ... $values) {
    $this->sequence = $values;
    $capacity = count($values);
    if ($capacity === 0) {
      $capacity = 10;
    }
    $this->capacity = $capacity;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->sequence);
  }

  /**
   * Gets the capacity
   * 
   * @return int the capacity
   */
  public function getCapacity(): int {
    return $this->capacity;
  }

  /**
   * Sets the capacity
   * 
   * @param  int $capacity new capacity
   * @return $this for a fluent interface
   * @throws OutOfBoundsException if the new capacity is smaller than the old one
   */
  public function setCapacity(int $capacity) {
    if ($this->capacity > $capacity) {
      throw new OutOfBoundsException("$capacity < $this->capacity");
    }
    $this->capacity = $capacity;
    return $this;
  }

  /**
   * Inserts values at a given index
   *
   * @param  int $index the index at which to insert
   * @param  mixed $values
   * @return $this for a fluent interface
   * @throws OutOfBoundsException
   */
  public function insert(int $index, mixed $values) {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not valid");
    }
    $this->sequence[$index] = $values;
    ksort($this->sequence);
    return $this;
  }

  /**
   * Pushes given values to the end of the sequence
   *
   * @param  mixed ... $value the value(s) to push
   * @return $this for a fluent interface
   */
  public function push(mixed ... $value) {
    foreach ($value as $val) {
      $this->sequence[] = $val;
    }
    $length = count($this->sequence);
    if ($this->getCapacity() < $length) {
      $this->setCapacity($length);
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
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not valid");
    }
    $value = $this->get($index);
    unset($this->sequence[$index]);
    return $value;
  }

  public function isValidIndex(int $index): bool {
    return $index >= 0 && $index < $this->getCapacity();
  }

  /**
   * Removes and returns a value by index
   * 
   * @param  int $index the index
   * @return mixed the removed value
   * @throws OutOfRangeException if the index is not valid.
   */
  public function get(int $index): mixed {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not valid");
    } else if (!$this->indexExists($index)) {
      return null;
    } else {
      return $this->sequence[$index];
    }
    $value = $this->sequence[$index];
    unset($this->sequence[$index]);
    return $value;
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
   * @return bool true if the queue is empty, false otherwise
   */
  public function isEmpty(): bool {
    return empty($this->sequence);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  int $index the index
   * @return bool true if the property exists and false otherwise
   */
  public function indexExists(int $index): bool {
    return isset($this->sequence[$index]) || array_key_exists($index, $this->sequence);
  }

  /**
   * Determines if the vector contains all values
   *
   * @param  mixed ...$values the atomic values to search for
   * @return bool true if the given atomic values exists
   */
  public function contains(mixed ...$values): bool {
    $exists = true;
    foreach ($values as $needle) {
      $exists = in_array($needle, $this->sequence, true);
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

  public function getIterator(): \Traversable {
    yield from $this->sequence;
  }

  /**
   * Joins all values together as a string
   * 
   * @param  string|null $glue an optional string to separate each value
   * @return string All values of the sequence joined together as a string
   */
  public function join(?string $glue = null): string {
    return implode((string) $glue, $this->sequence);
  }

  /**
   * Returns a reversed copy of the vector
   * 
   * @return Vector a reversed copy of the vecto
   */
  public function reversed(): Vector {
    $reversed = array_reverse($this->sequence, false);
    //print_r($this->sequence);
    //print_r($reversed);
    $out = new static(...$reversed);
    $out->setCapacity($this->getCapacity());
    return $out;
  }

}
