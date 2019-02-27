<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Component;

/**
 * Defines an XY Grid Cell
 *
 * **Important!**
 *
 * This component is mobile-first. Code for small screens first,
 * and larger devices will inherit those styles. Customize for
 * larger screens as necessary
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Cell extends Component {

  /**
   * Returns the layout manager
   * 
   * @return CellLayout the layout adapter
   */
  public function layout(): CellLayout;
}
