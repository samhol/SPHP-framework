<?php

/**
 * Stack.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Data;

use SplStack;

/**
 * An implementation of a last-in-first-out (LIFO) stack
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-10-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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

}
