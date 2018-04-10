<?php

/**
 * RowInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\CssClassifiableContent;

/**
 * Defines a Foundation framework based XY Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface RowInterface extends CssClassifiableContent, \Traversable {

  /**
   * Returns the layout manager
   * 
   * @return RowLayoutManager the layout manager
   */
  public function layout(): RowLayoutManager;

  /**
   * Sets the columns of the row (Removes existing content)
   *
   * **Important:**
   * 
   * * `$columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * * The widths of the `mixed $columns` extending {@link ColumnInterface} are kept
   * * The sum of the {@link ColumnInterface} widths in a {@link self} should not exceed 12.
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
  public function appendColumn($content, array $layout = ['auto']);

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
}
