<?php

/**
 * RowInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\ContainerComponentInterface as ContainerComponentInterface;

/**
 * Interface defines a Foundation row
 *
 * A Foundation Row is a horizontal block containing vertical {@link ColumnInterface} components.
 *
 * **Important:**
 * 
 * **The sum of the {@link ColumnInterface} widths on a specific screen size in a 
 * {@link self} should not exeed 12**. However if this sum do exeed 12, in most 
 * browser environments the excessive {@link Column} components are floated to 
 * a new 'row'. **HOWEVER!** this behaviour is not actively supported.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-27
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface RowInterface extends ContainerComponentInterface {
  /**
   * Constructs a new instance
   *
   * **Important:**
   *
   * Calculates the widths of the individual {@link ColumnInterface} components by dividing the Row width
   *  with the number of the inserted columns.
   *
   * if the number ofthe columns exceed the maximum width of the row, in most
   *  browser environments the excessive columns are floated to a new 'row'.
   * **HOWEVER** this behaviour is not actively supported.
   *
   * **Notes:**
   * 
   * * `$columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * * The widths of the `mixed $columns` extending {@link ColumnInterface} are kept
   * * The sum of the {@link ColumnInterface} widths in a {@link self} should not exeed 12.
   * 
   * @param  mixed|mixed[] $columns row columns
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */

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
   * **HOWEVER** this behaviour is not actively supported.
   *
   * **Notes:**
   * 
   * * `$columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * * The widths of the `mixed $columns` extending {@link ColumnInterface} are kept
   * * The sum of the {@link ColumnInterface} widths in a {@link self} should not exeed 12.
   * 
   * @param  mixed|mixed[] $columns 
   * @return self for PHP Method Chaining
   */
  public function setColumns($columns);

  /**
   * Appends a single {@link ColumnInterface} component to the row
   *
   * **Important:**
   *
   *  `$content` can be of any type that converts to a string or to a string[]
   *
   * @param  mixed|mixed[] $content column content
   * @param  int $small column width for small screens
   * @param  int $medium column width for medium screens
   * @param  int $large column width for large screens
   * @return self for PHP Method Chaining
   */
  public function appendColumn($content, $small = 12, $medium = null, $large = null);

  /**
   * Prepends {@link ColumnInterface} components to the row
   *
   * **Notes:**
   *
   * * the keys of the Row content will be renumbered starting from zero
   * * mixed $columns can be of any type that converts to a string or to a string[]
   * * all values of $columns not extending {@link Column} are wrapped with {@link Column} object
   *
   * @param  mixed|mixed[] $columns components
   * @return self for PHP Method Chaining
   */
  public function prepend($columns);

  /**
   * Appends a {@link ColumnInterface} component to the row
   *
   * **Notes:**
   *
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of $columns not extending {@link ColumnInterface} are wrapped with {@link Column} object
   *
   * @param  mixed|mixed[] $columns components
   * @return self for PHP Method Chaining
   */
  public function append($columns);

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
