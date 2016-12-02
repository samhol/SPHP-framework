<?php

/**
 * QueueInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use Exception;

/**
 * Defines properties of a First-In-First-Out (FIFO) queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface QueueInterface {

  /**
   * Adds a new item to the end of the queue
   *
   * @param  mixed $value the new item to add
   * @return self for PHP Method Chaining
   */
  public function enqueue($value);

  /**
   * Dequeues a node from the queue
   *
   * @return mixed the item at the beginning of the queue
   * @throws Exception if the queue is empty
   * @throws RuntimeException when the data-structure is empty
   */
  public function dequeue();

  /**
   * Observes the first item of the queue without removing it
   *
   * @return mixed the item at the beginning of the queue
   * @throws Exception if the queue is empty
   * @throws RuntimeException when the data-structure is empty
   */
  public function peek();

  /**
   * Determine if the queue is empty or not
   *
   * @return boolean true if the queue is empty, false otherwise
   */
  public function isEmpty();
}
