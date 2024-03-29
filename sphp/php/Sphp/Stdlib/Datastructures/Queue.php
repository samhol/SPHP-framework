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

use Sphp\Exceptions\UnderflowException;

/**
 * Defines properties of a First-In-First-Out (FIFO) queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Queue {

  /**
   * Adds a new item to the end of the queue
   *
   * @param  mixed $value the new item to add
   * @return $this for a fluent interface
   */
  public function enqueue(mixed $value);

  /**
   * Dequeues a node from the queue
   *
   * @return mixed the item at the beginning of the queue
   * @throws UnderflowException when the data-structure is empty
   */
  public function dequeue(): mixed;

  /**
   * Observes the first item of the queue without removing it
   *
   * @return mixed the item at the beginning of the queue
   * @throws UnderflowException when the data-structure is empty
   */
  public function peek(): mixed;

  /**
   * Determine if the queue is empty or not
   *
   * @return bool true if the queue is empty, false otherwise
   */
  public function isEmpty(): bool;
}
