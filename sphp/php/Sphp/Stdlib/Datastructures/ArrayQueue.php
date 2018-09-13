<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Sphp\Exceptions\UnderflowException;

/**
 * Implements an Queue using PHP arrays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ArrayQueue implements Queue {

  /**
   * @var array 
   */
  private $items;

  /**
   * Constructor
   * 
   * @param array $initial
   */
  public function __construct(array $initial = []) {
    $this->items = $initial;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->items);
  }

  public function dequeue() {
    if ($this->isEmpty()) {
      throw new UnderflowException('Cannot dequeue from empty queue');
    }
    return array_shift($this->items);
  }

  public function enqueue($value) {
    $this->items[] = $value;
    return $this;
  }

  public function isEmpty(): bool {
    return empty($this->items);
  }

  public function peek() {
    if ($this->isEmpty()) {
      throw new UnderflowException('Cannot peek empty queue');
    }
    return reset($this->items);
  }

}
