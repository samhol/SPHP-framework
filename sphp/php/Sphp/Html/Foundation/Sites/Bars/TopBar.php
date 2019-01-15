<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use InvalidArgumentException;

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
   * Constructor
   *
   * @param BarContentArea $left
   * @param BarContentArea $right
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
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the targeted screen size
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function stackFor(string $screenSize = null) {
    $this->cssClasses()->removePattern('/^(stacked-for-(small|medium|large|xlarge|xxlarge)+$/')->add("stacked-for-$screenSize");
    return $this;
  }

}
