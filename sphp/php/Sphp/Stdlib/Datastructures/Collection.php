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
use Sphp\Stdlib\Arrays;

/**
 * Implements a general purpose collection data structure
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Collection implements Iterator, CollectionInterface {

  /**
   * stored values
   *
   * @var array
   */
  private $items = [];

  /**
   * Constructor
   *
   * @param array $items optional initial values stored
   */
  public function __construct(array $items = []) {
    $this->items = $items;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->items);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->items = Arrays::copy($this->items);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  mixed $offset the offset key
   * @return boolean true if the property exists and false otherwise
   */
  public function offsetExists($offset): bool {
    return array_key_exists($offset, $this->items);
  }

  /**
   * Returns an item at a given offset
   *
   * @postcondition Returns null when the offset does not exist.
   * @param  mixed $offset the offset key
   * @return mixed the value of the property or null
   */
  public function offsetGet($offset) {
    $value = null;
    if ($this->offsetExists($offset)) {
      $value = $this->items[$offset];
    }
    return $value;
  }

  /**
   * Sets the item at a given offset
   *
   * @param  mixed $offset the offset key
   * @param  mixed $value the value to set
   * @return void
   */
  public function offsetSet($offset, $value): void {
    if (is_null($offset)) {
      $this->items[] = $value;
    } else {
      $this->items[$offset] = $value;
    }
  }

  /**
   * Unset the item at a given offset
   *
   * @param  mixed $offset the offset key
   * @return void
   */
  public function offsetUnset($offset): void {
    unset($this->items[$offset]);
  }

  /**
   * Appends a value to the collection
   * 
   * @param  mixed $value
   * @return $this for a fluent interface
   */
  public function append($value) {
    $this->items[] = $value;
    return $this;
  }

  /**
   * {@inheritdoc}
   * @complexity O(n)
   */
  public function prepend($value) {
    array_unshift($this->items, $value);
    return $this;
  }

  /**
   * Gets the items in the collection that are not present in the given items
   *
   * @param  mixed $items items to compare against
   * @return Collection new instance containing the items that are not present in the given items
   */
  public function diff($items): Collection {
    return new static(array_diff($this->items, $this->getArrayableItems($items)));
  }

  /**
   * Merge the collection with the given items
   *
   * @param  mixed $items
   * @return $this for a fluent interface
   */
  public function merge($items) {
    foreach ($this->getArrayableItems($items) as $key => $value) {
      $this->items[$key] = $value;
    }
    return $this;
  }

  /**
   * Results array of items from Collection 
   *
   * @param  mixed $items
   * @return array
   */
  protected function getArrayableItems($items): array {
    if (is_array($items)) {
      return $items;
    } else {
      return Arrays::toArray($items);
    }
  }

  /**
   * Clears the collection
   *
   * @return $this for a fluent interface
   */
  public function clear() {
    $this->items = [];
    return $this;
  }

  /**
   * Filters elements of a collection using a callback function
   *
   * @precondition $flag === {@link ARRAY_FILTER_USE_KEY} || $flag === {@link ARRAY_FILTER_USE_BOTH}
   * @param  callable $callback the callback function to use; If no callback is 
   *         supplied, all entries of array equal to `false` will be removed.
   * @param  int $flag flag determining what arguments are sent to callback
   * @return self new filtered collection
   */
  public function filter(callable $callback = null, int $flag = 0): Collection {
    return new static(array_filter($this->items, $callback, $flag));
  }

  /**
   * Execute a callback over each item
   *
   * @param  callable $callback
   * @return Collection new collection containing all the original elements after
   *         applying the callback to each one
   */
  public function map(callable $callback): Collection {
    $keys = array_keys($this->items);
    $items = array_map($callback, $this->items, $keys);
    return new static(array_combine($keys, $items));
  }

  /**
   * Checks if the given value exists in the collection
   * 
   * @param  mixed $value the value to search
   * @return boolean `true` if the given value exists, `false` otherwise
   */
  public function contains($value): bool {
    return in_array($value, $this->items, true);
  }

  /**
   * Removes all instances of the given value from the collection
   * 
   * @param  mixed $value the value to remove
   * @return $this for a fluent interface
   */
  public function remove($value) {
    $this->items = array_filter($this->items, function($var) use ($value) {
      return $var !== $value;
    });
    return $this;
  }

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty(): bool {
    return empty($this->items);
  }

  /**
   * Counts the number of items in the collection
   *
   * @return int the number of items in the collection
   */
  public function count(): int {
    return count($this->items);
  }

  /**
   * Returns the keys of the collection items
   *
   * @return mixed[] the keys of the collection items
   */
  public function keys(): array {
    return array_keys($this->items);
  }

  /**
   * Returns the collection as a plain PHP array
   *
   * @return array the collection as a plain PHP array
   */
  public function toArray(): array {
    return $this->items;
  }

  /**
   * Creates and returns new queue
   *
   * @return Queue new instance from the collection
   */
  public function toQueue(): Queue {
    $queue = new ArrayQueue();
    foreach ($this->items as $item) {
      $queue->enqueue($item);
    }
    return $queue;
  }

  /**
   * Creates and returns new stack
   *
   * @return Stack new instance from the collection
   */
  public function toStack(): Stack {
    $stack = new ArrayStack();
    foreach ($this->items as $item) {
      $stack->push($item);
    }
    return $stack;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->items);
  }

  /**
   * Advance the internal pointer of the collection
   *
   * @return void
   */
  public function next(): void {
    next($this->items);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->items);
  }

  /**
   * Rewinds the Iterator to the first element
   *
   * @return void
   */
  public function rewind(): void {
    reset($this->items);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current if iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->items);
  }

}
