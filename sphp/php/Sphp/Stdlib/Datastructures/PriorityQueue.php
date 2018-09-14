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
use Traversable;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use SplPriorityQueue;

/**
 * An implementation of a stable priority queue
 *
 * A priority queue is stable if deletions of items with equal
 *  priority value occur in the order in which they were inserted
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PriorityQueue implements Queue, Arrayable, IteratorAggregate, Countable {

  /**
   * seed value to maintain insertion order
   *
   * @var int
   */
  private $serial = PHP_INT_MAX;

  /**
   * @var SplPriorityQueue
   */
  private $innerQueue;

  /**
   * Constructor
   */
  public function __construct() {
    $this->innerQueue = new SplPriorityQueue();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->innerQueue);
  }

  /**
   * Add support for deep cloning
   *
   * @return void
   */
  public function __clone() {
    $this->innerQueue = clone $this->innerQueue;
  }

  public function toArray(): array {
    return iterator_to_array(clone $this);
  }

  public function dequeue() {
    $this->innerQueue->setExtractFlags(SplPriorityQueue::EXTR_DATA);
    return $this->innerQueue->extract();
  }

  /**
   * Inserts value with the priority in the queue
   *
   * @param mixed $value the value to insert
   * @param int $priority the associated priority
   * @return $this for a fluent interface
   */
  public function enqueue($value, int $priority = 0) {
    $this->innerQueue->insert($value, [$priority, $this->serial--]);
    return $this;
  }

  public function isEmpty(): bool {
    return $this->innerQueue->isEmpty();
  }

  public function peek() {
    $this->innerQueue->setExtractFlags(SplPriorityQueue::EXTR_DATA);
    return $this->innerQueue->top();
  }

  public function count(): int {
    return $this->innerQueue->count();
  }

  public function getIterator(): Traversable {
    return clone $this->innerQueue;
  }

}
