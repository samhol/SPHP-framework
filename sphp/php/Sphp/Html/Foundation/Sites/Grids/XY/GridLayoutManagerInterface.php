<?php

/**
 * ColumnLayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\LayoutManagerInterface;

/**
 * Defines a Column for a Row in a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface GridLayoutManagerInterface extends LayoutManagerInterface {

  /**
   *
   * @param string $type
   * @return $this for a fluent interface
   */
  public function stretch(string $type = 'fluid');

  /**
   *
   * @return bool
   */
  public function isStretched(): bool;

  /**
   *
   * @return $this for a fluent interface
   */
  public function unStretch();
}
