<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\LayoutManager;

/**
 * Defines a layout object for a XY Grid (Row container)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface GridLayout extends LayoutManager {

  /**
   * Stretches the content to the full width of the available space
   * 
   * @param  boolean $fluid true for stretched false otherwise
   * @return $this for a fluent interface
   */
  public function setFluid(bool $fluid = false);

  /**
   * Stretches the content to the full width of the available space and removes 
   * grid container padding
   * 
   * @param  boolean $full true for stretched false otherwise
   * @return $this for a fluent interface
   */
  public function setFull(bool $full = false);
}
