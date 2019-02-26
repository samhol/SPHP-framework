<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Implements Foundation XY Grid call layout adapter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#basics XY Grid cell
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface CellLayoutAdapter {

  public function setWidth(string $screen, $value);

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidth(string $screenSize);

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function unsetWidths();

  /**
   * Sets an offset for given screen size
   * 
   * @param  string $screenSize the target screen size
   * @param  int $value
   * @return $this for a fluent interface
   */
  public function setOffset(string $screenSize, int $value);

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOffset(string $screenSize);

  /**
   * Unsets the cell offsets
   *
   * @return $this for a fluent interface
   */
  public function unsetOffsets();

  /**
   * Unsets the column width associated with the given screen size to be inherited from smaller screens

   * @return $this for a fluent interface
   */
  public function reset();

  public function setLayouts(...$layouts);

  public function fromCssClass(string $cssClass);

  public function shrink();

  public function auto();
}
