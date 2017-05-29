<?php

/**
 * LayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Defines a layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LayoutManagerInterface {

  /**
   * Sets the layout
   *
   * @param  string $layouts layout parameters
   * @return self for a fluent interface
   */
  public function setLayouts(array $layouts);

  public function unsetLayouts();
}
