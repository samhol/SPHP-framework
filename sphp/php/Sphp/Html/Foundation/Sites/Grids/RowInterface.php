<?php

/**
 * RowInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\ContainerComponentInterface;

/**
 * Defines a Row for a Grid
 *
 * A Foundation Row is a horizontal block containing vertical {@link ColumnInterface} components.
 *
 * **Important:**
 * 
 * **The sum of the {@link ColumnInterface} widths on a specific screen size in a 
 * {@link self} should not exeed 12**. However if this sum do exeed 12, in most 
 * browser environments the excessive {@link Column} components are floated to 
 * a new 'row'. **HOWEVER!** this behavior is not actively supported.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-27
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RowInterface extends ContainerComponentInterface {

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
   * @return self for a fluent interface
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
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   * @return self for a fluent interface
   */
  public function appendColumn($content, $s = 12, $m = false, $l = false, $xl = false, $xxl = false);

  /**
   * Prepends {@link ColumnInterface} components to the row
   *
   * **Notes:**
   *
   * * `mixed $column` can be of any type that converts to a string or to a string[]
   * * a values of `$column` not extending {@link ColumnInterface} is wrapped with {@link Column} object
   *
   * @param  mixed|mixed[] $columns components
   * @return self for a fluent interface
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
   * @return self for a fluent interface
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

  /**
   * 
   * @param  boolean $collapse
   * @return self for a fluent interface
   */
  public function collapseColumns($collapse = true);
}
