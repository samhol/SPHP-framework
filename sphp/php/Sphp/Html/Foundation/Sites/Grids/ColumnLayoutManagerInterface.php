<?php

/**
 * ColumnLayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Core\LayoutManager;

/**
 * Defines a Column for a Row in a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
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
   * @param  string $value,... column widths for different screens sizes
   * @return $this for a fluent interface
   */
  public function setWidths(...$value);

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function unsetWidths(string $screenSize = null);

  /**
   * Removes the column offset values
   * 
   * Optinally
   * 
   * @return $this for a fluent interface
   */
  public function unsetOffsets();

  /**
   * Sets the column offset values
   *
   * @param  string|string[],... $offsets column offsets for different screens sizes
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
}
