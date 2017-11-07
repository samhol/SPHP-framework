<?php

/**
 * LayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

/**
 * Defines a layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LayoutManager {

  /**
   * Sets the layout
   *
   * @param  mixed|mixed[] $layouts layout parameters
   * @return $this for a fluent interface
   */
  public function setLayouts( ... $layouts);

  /**
   * Unsets the layout
   *
   * @return $this for a fluent interface
   */
  public function unsetLayouts();
}
