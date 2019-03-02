<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use IteratorAggregate;
use Countable;
use Traversable;
use ArrayIterator;
use Sphp\Exceptions\UnderflowException;

/**
 * Implements an unique priority queue
 * 
 * Unique priority queue is a priority queue containing distinct values
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://php.net/manual/en/class.splpriorityqueue.php the SplPriorityQueue class
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class UniquePriorityQueue implements IteratorAggregate, Countable, Queue, Arrayable {

  /**
   * the inner container
   *
   * @var array
   */
  private $queue;

  /**
   * Constructor
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
   * Attempts to add a value to the queue
   * 
   * 1. A Value will not be inserted if it already exists in the queue with higher priority
   * 2. Replaces existing identical value that has a smaller priority
   * 
   * @precondition  $priority >= 0
   * @postcondition getPriority($value) >= $priority
   * @param  mixed $value the object to add
   * @param  int $priority the associated priority as a positive integer
   * @return $this for a fluent interface
   */
  public function enqueue($value, int $priority = 0) {
    $this->queue[$priority][] = $value;
    krsort($this->queue);
    return $this;
  }

  /**
   * Removes all instances of the given value from the queue
   * 
   * @param  mixed $value the value to remove
   * @return $this for a fluent interface
   */
  public function remove($value) {
    $f = function($val) use($value) {
      return $value !== $val;
    };
    foreach ($this->queue as $priority => $bucket) {
      $this->queue[$priority] = array_filter($bucket, $f);
      if (empty($this->queue[$priority])) {
        unset($this->queue[$priority]);
      }
    }
    return $this;
  }

  /**
   * Checks if the queue contains a specific value
   * 
   * @param  mixed $value
   * @return boolean true if the value is in the queue, false otherwise
   */
  public function contains($value): bool {
    $result = false;
    foreach ($this->queue as $bucket) {
      $result = in_array($value, $bucket);
      if ($result) {
        break;
      }
    }
    return $result;
  }

  /**
   * {@inheritdoc}
   * @throws UnderflowException if the queue is empty
   */
  public function dequeue() {
    //var_dump($this->queue);
    reset($this->queue);
    $priority = key($this->queue);
    if ($priority === null) {
      throw new UnderflowException('Cannot dequeue from an empty queue');
    }
    // var_dump($values);
    //var_dump($this->queue);
    //echo "priority: $priority\n";
    if (is_array($this->queue[$priority])) {
      if (!empty($this->queue[$priority])) {

        $value = array_shift($this->queue[$priority]);
        //echo "\n$value";
      }
      if (empty($this->queue[$priority])) {
        //echo "emprty";
        unset($this->queue[$priority]);
      }
    }
    return $value;
  }

  public function isEmpty(): bool {
    return empty($this->queue);
  }

  public function peek() {
    reset($this->queue);
    $priority = key($this->queue);
    if ($priority === null) {
      throw new UnderflowException('Cannot peek from an empty queue');
    }
    return reset($this->queue[$priority]);
  }

  /**
   * Returns the number of values in the queue
   * 
   * @return int the number of values in the queue
   */
  public function count(): int {
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
  public function getIterator(): Traversable {
    return new ArrayIterator($this->toArray());
  }

  public function toArray(): array {
    $result = [];
    foreach ($this->queue as $obj) {
      $result = array_merge($result, $obj);
    }
    return $result;
  }

}
