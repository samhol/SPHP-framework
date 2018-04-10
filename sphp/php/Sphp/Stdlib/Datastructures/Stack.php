<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use SplStack;
use Sphp\Exceptions\RuntimeException;

/**
 * An implementation of a last-in-first-out (LIFO) stack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Stack extends SplStack implements StackInterface {

  public function peek() {
    return $this->top();
  }

  public function push($value) {
    parent::push($value);
    return $this;
  }

  public function pop() {
    try {
      return parent::pop();
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

}
