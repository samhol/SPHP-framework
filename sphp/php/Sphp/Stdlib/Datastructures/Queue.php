<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use SplQueue;
use Sphp\Exceptions\RuntimeException;

/**
 * An implementation of a first-in-first-out (FIFO) queue
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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

  public function isEmpty(): bool {
    return parent::isEmpty();
  }

}
