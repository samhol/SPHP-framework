<?php

/**
 * Queue.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

use SplQueue;
use Sphp\Exceptions\RuntimeException;

/**
 * An implementation of a first-in-first-out (FIFO) queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Queue extends SplQueue implements QueueInterface {

  public function peek() {
    return $this->bottom();
  }

  public function enqueue($value) {
    parent::enqueue($value);
    return $this;
  }

  public function dequeue() {
    try {
      return parent::dequeue();
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
