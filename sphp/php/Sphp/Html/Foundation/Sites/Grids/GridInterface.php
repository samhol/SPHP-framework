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
use Sphp\Html\TraversableContent;

/**
 * Defines a Foundation framework based XY Grid container for rows
 *
 * **Important!**
 *
 * This component is mobile-first. Code for small screens first,
 * and larger devices will inherit those styles. Customize for
 * larger screens as necessary
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface GridInterface extends CssClassifiableContent, TraversableContent {

  /**
   * Returns the Grid layout manager
   * 
   * @return GridLayoutManagerInterface the layout manager
   */
  public function layout(): GridLayoutManagerInterface;

  /**
   * Appends a new row to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row);

  /**
   * Prepends a new row to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   * * The numeric keys of the content will be renumbered starting from zero 
   *    and the index of the prepended row is 'int(0)' 
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row);

  /**
   * Returns all column components from the grid
   * 
   * @return TraversableContent containing all the column components
   */
  public function getColumns(): TraversableContent;
}
