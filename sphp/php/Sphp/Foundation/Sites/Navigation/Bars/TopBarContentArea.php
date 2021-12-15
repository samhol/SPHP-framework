<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Navigation\Bars;

/**
 * Implements a Title Bar content area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TopBarContentArea extends AbstractBarContentArea {

  /**
   * Constructor
   *
   * @precondition $side == 'left' | 'right'
   * @param string $side the side of the container
   */
  public function __construct(string $side) {
    parent::__construct('div');
    $this->cssClasses()->protectValue("top-bar-$side");
  }

}
