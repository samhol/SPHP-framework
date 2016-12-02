<?php

/**
 * Collection.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use Iterator;
use Sphp\Core\Types\Arrays;
use UnderflowException;

/**
 * An implementation of a general purpose collection data structure
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Filters elements of a collection using a callback function
   *
   * @precondition $flag === {@link ARRAY_FILTER_USE_KEY} || $flag === {@link ARRAY_FILTER_USE_BOTH}
   * @param  callable $callback the callback function to use; If no callback is 
   *         supplied, all entries of array equal to `false` will be removed.
   * @param  int $flag flag determining what arguments are sent to callback
   * @return self new filtered collection
   */
  public function filter(callable $callback = null, $flag = 0) {
    return new static(array_filter($this->items, $callback, $flag));
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

  public function contains($value) {
    return in_array($value, $this->items, true);
  }

  public function remove($value) {
    $f = function($var) use ($value) {
      return $var !== $value;
    };
    $this->items = array_filter($this->items, $f);
    return $this;
  }

  /**
   * Determine if the collection is empty or not
   *
   * @return boolean true if the collection is empty, false otherwise
   */
  public function isEmpty() {
    return empty($this->items);
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
   * Returns the collection as a plain PHP array
   *
   * @return array the collection as a plain PHP array
   */
  public function toArray() {
    return $this->items;
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

  /**
   * Removes the item at the top of the stack and returns that item as the value
   *
   * @complexity O(1)
   * @return mixed the top-most element or null If the stack is empty
   */
  public function pop() {
    if ($this->isEmpty()) {
      throw new UnderflowException();
    }
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
    if ($this->isEmpty()) {
      throw new UnderflowException();
    }
    return array_shift($this->items);
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
   */
  public function next() {
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
   */
  public function rewind() {
    reset($this->items);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return false !== current($this->items);
  }

}
