<?php

/**
 * Collection.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use Sphp\Util\Arrays as Arrays;

/**
 * An implementation of a general purpose collection data structure
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Collection implements CollectionInterface {

  use ArrayAccessExtensionTrait;

  /**
   * stored values
   *
   * @var array
   */
  private $items = [];

  /**
   * Constructs a new instance
   *
   * @param array $items optional inital values stored
   */
  public function __construct(array $items = []) {
    $this->items = $items;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
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
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString() {
    return Arrays::implodeWithKeys($this->items);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  mixed $offset the offset key
   * @return boolean true if the property exists and false otherwise
   */
  public function offsetExists($offset) {
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
    if ($this->offsetExists($offset)) {
      $value = $this->items[$offset];
    } else {
      $value = null;
    }
    return $value;
  }

  /**
   * Sets the item at a given offset
   *
   * @param  mixed $offset the offset key
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   */
  public function offsetSet($offset, $value) {
    if (is_null($offset)) {
      $this->items[] = $value;
    } else {
      $this->items[$offset] = $value;
    }
    return $this;
  }

  /**
   * Unset the item at a given offset
   *
   * @param  mixed $offset the offset key
   * @return self for PHP Method Chaining
   */
  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->items[$offset]);
    }
    return $this;
  }

  /**
   * Push an item onto the beginning of the collection
   *
   * @param  mixed $value the value to prepend
   * @return self for PHP Method Chaining
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
   * @return self new instance containing the items that are not present in the given items
   */
  public function diff($items) {
    return new static(array_diff($this->items, $this->getArrayableItems($items)));
  }

  /**
   * Merge the collection with the given items
   *
   * @param  mixed $items
   * @return self for PHP Method Chaining
   */
  public function merge($items) {
    $this->items = array_merge($this->items, $this->getArrayableItems($items));
    return $this;
  }

  /**
   * Removes the item at the top of the collection and returns that item as the value
   *
   * @return mixed the top-most element or null If the collection is empty
   * @complexity O(1)
   */
  public function pop() {
    return array_pop($this->items);
  }

  /**
   * Shift an item off the beginning of the collection
   *
   * Shifts the first item off and returns it, shortening the collection by one
   * and moving everything down. All numerical keys will be modified to start
   * counting from zero while literal keys won't be touched.
   *
   * @return mixed the first item of the collection or null If the collection is empty
   * @complexity O(n)
   */
  public function shift() {
    return array_shift($this->items);
  }

  /**
   * Set the internal pointer of the collection to its last item, and returns its value
   *
   * @return mixed the value of the last item or null for empty collection
   */
  public function end() {
    $value = end($this->items);
    if ($value === false && $this->isEmpty()) {
      $value = null;
    }
    return $value;
  }

  /**
   * Advance the internal pointer of the collection
   *
   * @return mixed|false the value in the next place that's pointed to by the
   *         internal pointer, or false if there are no more elements.
   */
  public function next() {
    return next($this->items);
  }

  /**
   * Results array of items from Collection or Arrayable
   *
   * @param  mixed $items
   * @return array
   */
  protected function getArrayableItems($items) {
    if ($items instanceof Arrayable) {
      $items = $items->toArray();
    } else if ($items instanceof Jsonable) {
      $items = json_decode($items->toJson(), true);
    }
    return (array) $items;
  }

  /**
   * Clears all stored properties
   *
   * @return self for PHP Method Chaining
   */
  public function clear() {
    $this->items = [];
    return $this;
  }

  /**
   * Execute a callback over each item
   *
   * @param  callable $callback
   * @return self new collection containing all the original elements after
   *         applying the callback to each one
   */
  public function map(callable $callback) {
    $keys = array_keys($this->items);
    $items = array_map($callback, $this->items, $keys);
    return new static(array_combine($keys, $items));
  }

  /**
   * Determines whether the given value is stored
   *
   * @param  mixed $value the value to search for
   * @return boolean true if the given value is stored, false otherwise
   */
  public function contains($value) {
    return in_array($value, $this->items);
  }

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty() {
    return count($this->items) === 0;
  }

  /**
   * Counts the number of items in the collection
   *
   * @return int the number of items in the collection
   */
  public function count() {
    return count($this->items);
  }

  /**
   * Returns the keys of the collection items
   *
   * @return mixed[] the keys of the collection items
   */
  public function keys() {
    return array_keys($this->items);
  }

  /**
   * Retrieves an external iterator to iterate through the collection items
   *
   * @return \ArrayIterator to iterate through the collection items
   */
  public function getIterator() {
    return new \ArrayIterator($this->items);
  }

  /**
   * Returns the collection as a plain PHP array
   *
   * @return array the collection as a plain PHP array
   */
  public function toArray() {
    return array_map(function ($value) {
      return $value instanceof Arrayable ? $value->toArray() : $value;
    }, $this->items);
  }

  /**
   *
   * @return Queue
   */
  public function toQueue() {
    $queue = new Queue();
    foreach ($this->items as $item) {
      $queue->enqueue($item);
    }
    return $queue;
  }

  /**
   *
   * @return Stack
   */
  public function toStack() {
    $stack = new Stack();
    foreach ($this->items as $item) {
      $stack->push($item);
    }
    return $stack;
  }

}
