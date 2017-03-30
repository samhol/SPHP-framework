<?php

/**
 * ColumnInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Defines a Column for a Row in a Grid system
 *
 * The sum of the column widths and offsets in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColumnInterface {

  /**
   * Sets the column width associated with the given screen size(s)
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first, and 
   * larger devices will inherit those styles. Customize for larger screens 
   * as necessary.
   *
   * @precondition The value of the `$width` parameter is between 1-12 or false for inheritance
   * @precondition `$screen` == `small|medium|large|xlarge|xxlarge`
   * @param  int $width the width of the column
   * @param  string $screen the target screen size
   * @return self for a fluent interface
   */
  public function setWidth($width, $screen = 'small');

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function setWidthInherited($screenSize);

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   * @return self for a fluent interface
   */
  public function setWidths($s, $m = false, $l = false, $xl = false, $xxl = false);

  /**
   * Returns the column width associated with the given screen size
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int|boolean the width of the column (1-12) or false for inheritance 
   *         from smaller screens
   */
  public function getWidth($screenSize);

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
  public function setGridOffset($offset, $screenSize = "small");

  /**
   * Returns the column offset for the target screen
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen type
   * @return int the width of the column (0-11)
   */
  public function getGridOffset($screenSize);

  /**
   * Unsets the grid offset of the column
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function inheritGridOffset($screenSize);

  /**
   * Returns the amount of the space the column uses from the grid row
   * 
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return int
   */
  public function countUsedSpace($screenSize);

  /**
   * Centers the column to the Foundation row
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function centerize($screenSize);

  /**
   * Resets the centering of the column
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return self for a fluent interface
   */
  public function uncenterize($screenSize);
}
