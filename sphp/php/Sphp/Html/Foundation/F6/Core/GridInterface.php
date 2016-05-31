<?php

/**
 * GridInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\ContainerInterface as ContainerInterface;
use Sphp\Html\Container as Container;

/**
 * Interface defines a Foundation Grid
 * 
 * A Grid component is a container for {@link RowInterface} components.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-24
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface GridInterface extends ContainerInterface {

  /**
   * Returns the input as an array of {@link RowInterface} components
   *
   * **Important:**
   * 
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component.
   *
   * @param  mixed|RowInterface $row a row content or a row component
   * @return Row wrapped row component
   */
  public function toRow($row);

  /**
   * Appends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row);

  /**
   * Prepends a new {@link RowInterface} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   * * The numeric keys of the content will be renumbered starting from zero 
   *    and the index of the prepended row is 'int(0)' 
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row);

  /**
   * Assigns a {@link RowInterface} to the specified offset
   *
   * **Important!**
   *
   * * `$row` not extending {@link RowInterface} is wrapped inside a {@link RowInterface} component 
   *   using {@link self::toRow()} method.
   *
   * @param mixed $offset the offset to assign the value to
   * @param  mixed|RowInterface $row the new row or the content of the new row
   */
  public function offsetSet($offset, $row);

  /**
   * Returns all {@link ColumnInterface} components from the grid
   * 
   * @return Container containing all the {@link ColumnInterface} components
   */
  public function getColumns();
}
