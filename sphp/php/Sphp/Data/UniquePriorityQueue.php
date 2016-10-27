<?php

/**
 * UniquePriorityQueue.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use IteratorAggregate;
use Countable;
use Sphp\Core\Types\Arrays;
use Traversable;
use ArrayIterator;
use UnderflowException;

/**
 * Class implements an unique priority queue
 * 
 * Unique priority queue is a priority queue containing distinct values
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-18
 * @link    http://php.net/manual/en/class.splpriorityqueue.php the SplPriorityQueue class
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UniquePriorityQueue implements IteratorAggregate, Countable, QueueInterface, Arrayable {

  /**
   * the inner container
   *
   * @var [] 
   */
  private $queue;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->queue = [];
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->queue);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->queue = Arrays::copy($this->queue);
  }

  /**
   * Attempts to add a value to the queue
   * 
   * 1. A Value will not be inserted if it already exists in the queue with higher priority
   * 2. Replaces existing identical value that has a smaller priority
   * 
   * @precondition  $priority >= 0
   * @postcondition getPriority($value) >= $priority
   * @param  mixed $value the object to add
   * @param  int $priority the associated priority as a positive integer
   * @return self for PHP Method Chaining
   */
  public function enqueue($value, $priority = 0) {
    $oldPriority = $this->getPriority($value);
    //echo "enqueue:$value\n";
    if ($oldPriority === false) {
      //echo "enqueueing1:$value\n";
      $this->queue[(int) $priority][] = $value;
      ksort($this->queue);
      // print_r($this->queue);
    } else if ($priority < $oldPriority) {
      $this->remove($value);
      $this->queue[(int) $priority][] = $value;
      ksort($this->queue);
      //echo "enqueueing2:$value\n";
    }
    //print_r($this->queue);
    //reset($this->queue);
    return $this;
  }

  /**
   * Removes the given value from the queue
   * 
   * @param  mixed $value the value to delete
   * @return self for PHP Method Chaining
   */
  public function remove($value) {
    $f = function($val) use($value) {
      if (is_array($val)) {
        return !empty($val);
      } else {
        return $value !== $val;
      }
    };
    $this->queue = Arrays::filterRecursive($this->queue, $f);
    return $this;
  }

  /**
   * Returns the priority of the given value
   * 
   * @param  mixed $value the value to check for
   * @return int|boolean the priority of the value or false if value is not in the queue
   */
  public function getPriority($value) {
    $result = false;
    foreach ($this->queue as $priority => $values) {
      if (in_array($value, $values, true)) {
        $result = $priority;
        break;
      }
    }
    return $result;
  }

  /**
   * Checks if the queue already contains a specific value
   * 
   * @param  mixed $value
   * @return boolean true if the value is in the queue, false otherwise
   */
  public function contains($value) {
    return Arrays::inArray($value, $this->queue);
  }

  /**
   * {@inheritdoc}
   * @throws UnderflowException if the queue is empty
   */
  public function dequeue() {
    //var_dump($this->queue);
    $values = reset($this->queue);
    // var_dump($values);
    //var_dump($this->queue);
    if (is_array($values) && count($values) > 0) {
      $value = array_shift($values);
      if (empty($values)) {
        array_shift($this->queue);
      }
    } else {
      throw new UnderflowException('Cannot dequeue from an empty queue');
    }
    return $value;
  }

  public function isEmpty() {
    return empty($this->queue);
  }

  public function peek() {
    $values = reset($this->queue);
    return reset($values);
  }

  /**
   * Returns the number of values in the queue
   * 
   * @return int the number of values in the queue
   */
  public function count() {
    $count = 0;
    foreach ($this->queue as $values) {
      $count += count($values);
    }
    return $count;
  }

  /**
   * Retrieves an external iterator
   * 
   * @return Traversable external iterator
   */
  public function getIterator() {
    return new ArrayIterator($this->toArray());
  }

  public function toArray() {
    $result = [];
    foreach ($this->queue as $obj) {
      $result = array_merge($result, $obj);
    }
    return $result;
  }

}
