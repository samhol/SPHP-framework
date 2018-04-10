<?php

/**
 * ColumnInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\CssClassifiableContent;

/**
 * Defines a Foundation framework based XY Grid Column
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
interface ColumnInterface extends CssClassifiableContent {

  /**
   * Returns the layout manager
   * 
   * @return ColumnLayoutManagerInterface the layout manager
   */
  public function layout(): ColumnLayoutManagerInterface;
}
