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
 * Defines a XY Grid (Row container)
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
interface Grid extends CssClassifiableContent, TraversableContent {

  /**
   * Stretches the content to the full width of the available space
   * 
   * @param  boolean $fluid true for stretched false otherwise
   * @return $this for a fluent interface
   */
  public function setFluid(bool $fluid = false);

  /**
   * Stretches the content to the full width of the available space and removes 
   * grid container padding
   * 
   * @param  boolean $full true for stretched false otherwise
   * @return $this for a fluent interface
   */
  public function setFull(bool $full = false);

  /**
   * Appends a new row to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|Row $row the new row or the content of the new row
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
   * @param  mixed|Row $row the new row or the content of the new row
   * @return $this for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row);

  /**
   * Returns all column components from the grid
   * 
   * @return TraversableContent containing all the column components
   */
  public function getCells(): TraversableContent;
}
