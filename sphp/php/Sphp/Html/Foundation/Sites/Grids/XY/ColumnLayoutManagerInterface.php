<?php

/**
 * ColumnLayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\Foundation\Sites\Core\LayoutManager;

/**
 * Defines a Column for a Row in a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColumnLayoutManagerInterface extends LayoutManager {

  /**
   * @return int 
   */
  public function getMaxSize(): int;

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string $widths column widths for different screens sizes
   * @return $this for a fluent interface
   */
  public function setWidths(...$value);

  /**
   * 
   * @return $this for a fluent interface
   */
  public function unsetWidths();

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidth(string $screenSize);

  /**
   * Offsets the column component to right on the associated screen sizes
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @precondition The value of the `$offset` parameter is between 0-11 or false for inheritance
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  int|boolean $offset the column offset (0-11) or false for inheritance
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  //public function setOffset(int $offset, string $screenSize = 'small');

  /**
   * 
   * @return $this for a fluent interface
   */
  public function unsetOffsets();

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string|string[] $offsets column offsets for different screens sizes
   * @return $this for a fluent interface
   */
  public function setOffsets(... $offsets);

  /**
   * Returns the column offset for the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen type
   * @return int the width of the column (0-11)
   */
  public function getOffset(string $screenSize): int;

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOffset(string $screenSize);

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string|string[] $orders column offsets for different screens sizes
   * @return $this for a fluent interface
   */
  public function setOrders(... $orders);

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrder(string $screenSize);

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetOrders();

  /**
   * Returns the amount of the space the column uses from the row
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int the amount of the space the column uses from the row
   */
  public function countUsedSpace(string $screenSize);

  /**
   * Centers the column to the Foundation row
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return ColumnInterface for PHP Method Chaining
   */
  public function centerize(string $screenSize);

  /**
   * Resets the centering of the column
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return ColumnLayoutManager for PHP Method Chaining
   */
  public function uncenterize(string $screenSize);

  /**
   * Removes the centering/uncentering settings
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return ColumnInterface for PHP Method Chaining
   */
  public function unsetCenterizing(string $screenSize);
}
