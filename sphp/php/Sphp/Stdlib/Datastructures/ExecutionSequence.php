<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use IteratorAggregate;
use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Stdlib\Datastructures\PriorityQueue;
use Countable;

/**
 * Implementation of an Execution Sequence
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ExecutionSequence implements Arrayable, IteratorAggregate, Countable {

  /**
   * @var PriorityQueue
   */
  private $callbacks;

  /**
   * Constructor
   */
  public function __construct() {
    $this->callbacks = new PriorityQueue();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->callbacks);
  }

  /**
   * Executed the sequence of callbacks
   *
   * @return void
   */
  public function __invoke(): void {
    foreach ($this->callbacks as $callback) {
      $callback();
    }
  }

  /**
   * Inserts a callable with a priority
   * 
   * @param  callable $object
   * @param  int $priority
   * @return $this for a fluent interface
   */
  public function addCallable(callable $object, int $priority = 0) {
    $this->callbacks->enqueue($object, $priority);
    return $this;
  }

  /**
   * Flushes the callbacks
   * 
   * @return $this for a fluent interface
   */
  public function flushSequence() {
    $this->callbacks = new PriorityQueue();
    return $this;
  }

  /**
   * Create a new iterator to iterate through inserted callables
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->callbacks->getIterator();
  }

  public function toArray(): array {
    return $this->callbacks->toArray();
  }

  /**
   * Count the number of contained callables 
   *
   * @return int number of callables
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return $this->callbacks->count();
  }

}
