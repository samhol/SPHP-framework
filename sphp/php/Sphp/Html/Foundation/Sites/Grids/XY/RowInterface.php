<?php

/**
 * RowInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\ContentInterface;

/**
 * Defines a Row for a Grid
 *
 * A Foundation Row is a horizontal block containing vertical {@link ColumnInterface} components.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RowInterface extends ContentInterface {

  /**
   * Sets the columns of the row (Removes existing content)
   *
   * **Important:**
   *
   * Calculates the widths of the individual {@link ColumnInterface} components 
   * by dividing the Row width with the number of the inserted columns.
   *
   * If the number of the columns exceed the maximum width of the row, in most
   *  browser environments the excessive columns are floated to a new 'row'.
   * **HOWEVER** this behavior is not actively supported.
   *
   * **Notes:**
   * 
   * * `$columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * * The widths of the `mixed $columns` extending {@link ColumnInterface} are kept
   * * The sum of the {@link ColumnInterface} widths in a {@link self} should not exeed 12.
   * 
   * @param  mixed|mixed[] $columns 
   * @return $this for a fluent interface
   */
  public function setColumns($columns);

  /**
   * Appends a single {@link ColumnInterface} component to the row
   *
   * **Important:**
   *
   * Parameter `$content` can be of any type that converts to a string or to a string[]
   *
   * @param  mixed $content the content of the column
   * @param  array $layout column layout parameters
   * @return $this for a fluent interface
   */
  public function appendColumn($content, array $layout = ['small-12']);

  /**
   * Prepends {@link ColumnInterface} components to the row
   *
   * **Notes:**
   *
   * * `mixed $column` can be of any type that converts to a string or to a string[]
   * * a values of `$column` not extending {@link ColumnInterface} is wrapped with {@link Column} object
   *
   * @param  mixed|mixed[] $columns components
   * @return $this for a fluent interface
   */
  public function prepend($columns);

  /**
   * Appends a {@link ColumnInterface} component to the row
   *
   * **Notes:**
   *
   * * `mixed $column` can be of any type that converts to a string or to a string[]
   * * a values of `$column` not extending {@link ColumnInterface} is wrapped with {@link Column} object
   *
   * @param  mixed|ColumnInterface $column content component
   * @return $this for a fluent interface
   */
  public function append($column);

  /**
   * Assigns a {@link ColumnInterface} component to the specified offset
   *
   * **Notes:**
   *
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of $columns not extending {@link ColumnInterface} are wrapped with {@link Column} object
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed $value the value to set
   */
  public function offsetSet($offset, $value);
}
