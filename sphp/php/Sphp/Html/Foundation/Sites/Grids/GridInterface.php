<?php

/**
 * GridInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\ContainerInterface;
use Sphp\Html\ContentInterface;
use Sphp\Html\TraversableInterface;

/**
 * Defines a Grid
 * 
 * A Grid component is a container for {@link RowInterface} components.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-24
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface GridInterface extends ContentInterface, TraversableInterface {

  /**
   * Appends a new row to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row);

  /**
   * Returns all {@link ColumnInterface} components from the grid
   * 
   * @return ContainerInterface containing all the {@link ColumnInterface} components
   */
  public function getColumns();
}
