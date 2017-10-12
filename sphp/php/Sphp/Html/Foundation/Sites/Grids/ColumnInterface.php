<?php

/**
 * ColumnInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\ComponentInterface;

/**
 * Defines a Column for a Row in a Foundation Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColumnInterface extends ComponentInterface {

  /**
   * @return ColumnLayoutManagerInterface 
   */
  public function layout();
}
