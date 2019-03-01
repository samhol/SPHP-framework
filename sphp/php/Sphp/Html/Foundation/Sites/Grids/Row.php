<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\CssClassifiableContent;

/**
 * Defines a XY Grid Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Row extends CssClassifiableContent, \Traversable {

  public function setLayouts(...$layout);

  /**
   * Unsets all layout settings 
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts();

  /**
   * 
   * @param  bool $margin
   * @return $this for a fluent interface
   */
  public function useMargin(bool $margin = true);

  /**
   * 
   * @param  bool $padding
   * @return $this for a fluent interface
   */
  public function usePadding(bool $padding = true);

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function collapse(string $screenSize);

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function uncollapse(string $screenSize);

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function reset(string $screenSize);

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
   * @param  mixed|mixed[] $cells 
   * @return $this for a fluent interface
   */
  public function setCells($cells);

  /**
   * Prepends a Cell instance to the row
   *
   * @param  Cell $cell components
   * @return $this for a fluent interface
   */
  public function prepend(Cell $cell);

  /**
   * Appends a Cell instance to the row
   *
   * @param  Cell $cell content component
   * @return $this for a fluent interface
   */
  public function append(Cell $cell);

  /**
   * Creates and appends a new Cell instance to the row
   *
   * **Important:**
   *
   * Parameter `$content` can be of any type that converts to a string or to a string[]
   *
   * @param  mixed $content the content of the cell
   * @param  string[] $layout Cell layout parameters (CSS classes)
   * @return Cell appended cell
   */
  public function appendCell($content, array $layout = ['auto']): Cell;
}
