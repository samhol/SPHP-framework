<?php

/**
 * Queue.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

/**
 * An implementation of a first-in-first-out (FIFO) queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-06
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Queue extends \SplQueue implements QueueInterface {

  /**
   * {@inheritdoc}
   */
  public function peek() {
    return $this->bottom();
  }

  /**
   * {@inheritdoc}
   */
  public function enqueue($value) {
    parent::enqueue($value);
    return $this;
  }

}
