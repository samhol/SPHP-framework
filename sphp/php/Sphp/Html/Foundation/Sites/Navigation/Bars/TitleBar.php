<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Bars;

/**
 * Implements a Title Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TitleBar extends AbstractBar {

  /**
   * Constructor
   *
   * @param TitleBarContentArea $left
   * @param TitleBarContentArea $right
   */
  public function __construct(TitleBarContentArea $left = null, TitleBarContentArea $right = null) {
    if ($left === null) {
      $left = new TitleBarContentArea('left');
    }
    if ($right === null) {
      $right = new TitleBarContentArea('right');
    }
    parent::__construct('div', $left, $right);
    $this->cssClasses()->protectValue('title-bar');
  }

}
