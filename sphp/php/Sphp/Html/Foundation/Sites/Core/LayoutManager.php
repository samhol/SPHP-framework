<?php

/**
 * LayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Adapters\Adapter;

/**
 * Defines a layout manager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LayoutManager extends Adapter {

  /**
   * Sets the layouts
   *
   * @param  string|string[] $layouts layout parameters (CSS classes)
   * @return $this for a fluent interface
   */
  public function setLayouts(... $layouts);

  /**
   * Unsets the layout
   *
   * @return $this for a fluent interface
   */
  public function unsetLayouts();
}
