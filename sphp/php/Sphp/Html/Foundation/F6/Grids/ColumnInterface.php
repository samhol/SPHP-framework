<?php

/**
 * ColumnInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Grids;

/**
 * Interface defines Foundation 6 based column component to create multi-device layouts
 *
 * The sum of the column widths and offsets in a row should never exeed 12.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColumnInterface {

  /**
   * The maximum width of the column (int 12)
   */
  const FULL_WIDTH = 12;

  /**
   * The width is inherited from the smaller screen settings (int 0)
   */
  const INHERITED = 0;

  /**
   * Sets the column width associated with the given screen size(s)
   *
   * **Important!**
   *
   * Column component is mobile-first. Code for small screens first, and 
   * larger devices will inherit those styles. Customize for larger screens 
   * as necessary.
   *
   * @precondition parameter `$width` has an integer value between 0-12
   * @precondition parameter `$screen` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int $width the width of the column
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function setWidth($width, $screens = "small");

  /**
   * Sets the column width associated with the given screen size to be inherited from smaller screens
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function setWidthInherited($screens);

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  int|boolean $small column width for small screens (0-12)
   * @param  int|boolean $medium column width for medium screens (0-12)
   * @param  int|boolean $large column width for large screens (0-12)
   * @param  int|boolean $xlarge column width for x-large screens (0-12)
   * @param  int|boolean $xxlarge column width for xx-large screen)s (0-12)
   * @return self for PHP Method Chaining
   */
  public function setWidths($small, $medium = false, $large = false, $xlarge = false, $xxlarge = false);

  /**
   * Returns the column width associated with the given screen size
   * 
   * @preconditions parameter `$screen` is either one of the constants 
   *         {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM},
   *         {@link Screen::LARGE} or one of the 
   *         strings `"small"`, `"medium"`, `"large"`
   * @param  int|string $screen the target screen type
   * @return int the width of the column (0-12)
   */
  public function getWidth($screen = "small");

  /**
   * Offsets the column component to the right
   * 
   * Moves Column block up to 11 columns to the right.
   *
   * @precondition parameter `$width` has an integer value between 0-11
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int $offset the number of the columns moved
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function setGridOffset($offset, $screens = "small");

  /**
   * Returns the column width for the target screen
   *
   * @preconditions parameter `$screen` is either one of the constants 
   *         {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM},
   *         {@link Screen::LARGE} or one of the 
   *         strings `"small"`, `"medium"`, `"large"`
   * @param  int $screen the target screen type
   * @return int the width of the column (0-12)
   */
  public function getGridOffset($screen);

  /**
   * Unsets the grid offset of the column
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function inheritGridOffset($screens);

  /**
   * Returns the amount of the space the column uses from the grid row
   * 
   * @preconditions  parameter `$screen` is either one of the constants 
   *                 {@link Screen::SMALL}, 
   *                 {@link Screen::MEDIUM},
   *                 {@link Screen::LARGE} or one of the strings 
   *                 `"small"`, `"medium"`, `"large"`
   * @param  int|string $screen
   * @return int
   */
  public function countUsedSpace($screen);

  /**
   * Centers the column to the {@link Row}
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function centerize($screens);

  /**
   * Resets the centering of the column
   *
   * @precondition parameter `$screens` has a bitmask value combining named 
   *         constants {@link Screen::SMALL}, 
   *         {@link Screen::MEDIUM} and 
   *         {@link Screen::LARGE} or aa combination of strings 
   *         `"small"`, `"medium"`, `"large"`
   * @param  int|string|BitMask $screens the target screen size(s)
   * @return self for PHP Method Chaining
   */
  public function uncenterize($screens);
}
