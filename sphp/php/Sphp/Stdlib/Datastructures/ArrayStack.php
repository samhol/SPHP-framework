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
 * An implementation of a last-in-first-out (LIFO) stack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ArrayStack implements Stack, Arrayable {

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

  public function peek() {
    if ($this->isEmpty()) {
      throw new UnderflowException('Cannot peek empty Stack');
    }
    return end($this->items);
  }

  public function push($value) {
    $this->items[] = $value;
    return $this;
  }

  public function pop() {
    if ($this->isEmpty()) {
      throw new UnderflowException('Cannot pop from empty stack');
    }
    return array_pop($this->items);
  }

  public function isEmpty(): bool {
    return empty($this->items);
  }

  public function toArray(): array {
    return $this->items;
  }

}
