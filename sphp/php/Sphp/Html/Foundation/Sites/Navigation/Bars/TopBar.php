<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

use Sphp\Html\ContainerComponent;
use InvalidArgumentException;

/**
 * Implements a Foundation Top Bar
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
   * @param TopBarContentArea $left
   * @param TopBarContentArea $right
   */
  public function __construct(TopBarContentArea $left = null, TopBarContentArea $right = null) {
    if ($left === null) {
      $left = new TopBarContentArea('left');
    }
    if ($right === null) {
      $right = new TopBarContentArea('right');
    }
    parent::__construct('div', $left, $right);
    $this->cssClasses()->protectValue('top-bar');
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
