<?php

/**
 * TopBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use InvalidArgumentException;
use Sphp\Html\Div;

/**
 * Implements a Top Bar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TopBar extends AbstractBar {

  /**
   * Constructs a new instance
   *
   * @param mixed $title the title of the Top Bar component
   */
  public function __construct(BarContentArea $left = null, BarContentArea $right = null) {
    if ($left === null) {
      $left = new BarContentArea('div');
    }
    $left->cssClasses()->protect('top-bar-left');
    if ($right === null) {
      $right = new BarContentArea('div');
    }
    $right->cssClasses()->protect('top-bar-right');
    parent::__construct('div', $left, $right);
    $this->cssClasses()->protect('top-bar');
  }

  public function __destruct() {
    unset($this->titleArea);
    parent::__destruct();
  }

  public function __clone() {
    $this->titleArea = clone $this->titleArea;
    parent::__clone();
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|large`
   * @param  string $screenSize the targeted screensize
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function stackFor(string $screenSize = null) {
    $this->cssClasses()->removePattern('/^(stacked-for-(small|medium|large|xlarge|xxlarge)+$/')->add("stacked-for-$screenSize");
    return $this;
  }

}
