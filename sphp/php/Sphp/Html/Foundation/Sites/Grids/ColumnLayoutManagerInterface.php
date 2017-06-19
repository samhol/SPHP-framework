<?php

/**
 * ColumnLayoutManagerInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\LayoutManagerInterface;

/**
 * Defines a Column for a Row in a Grid system
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColumnLayoutManagerInterface extends LayoutManagerInterface {

  /**
   * @return int 
   */
  public function getMaxSize(): int;

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string[] $widths column widths for different screens sizes
   * @return self for a fluent interface
   */
  public function setWidths(array $widths);

  /**
   * 
   * @return self for a fluent interface
   */
  public function unsetWidths();

  /**
   * Sets column width for the component
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first,
   * and larger devices will inherit those styles. Customize for
   * larger screens as necessary.
   *
   * @precondition The value of the `$width` parameter is between 1-12 or false 
   *               for inheritance from smaller screen sizes
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  int|boolean $width the width of the column or false for inheritance
   * @param  string $screen the target screen size
   * @return self for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setWidth(int $width, string $screen = 'small');

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function setOffset(int $offset, string $screenSize = 'small');

  /**
   * 
   * @return self for a fluent interface
   */
  public function unsetOffsets();

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string[] $offsets column offsets for different screens sizes
   * @return self for a fluent interface
   */
  public function setOffsets(array $offsets);

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
   * @return self for a fluent interface
   */
  public function unsetOffset(string $screenSize);

  /**
   * Sets the column offset values for all screen sizes
   *
   * @param  string[] $pushs column offsets for different screens sizes
   * @return self for a fluent interface
   */
  public function setOrders(array $pushs);

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function unsetOrder(string $screenSize);

  /**
   * Unsets the grid offset for the given screen size
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
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
