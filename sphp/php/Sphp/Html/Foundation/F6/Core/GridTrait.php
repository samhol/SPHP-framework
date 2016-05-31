<?php

/**
 * GridTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Container as Container;

/**
 * Trait implements {@link GridInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-24
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation 6 grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait GridTrait {

  /**
   * Returns the input as an array of {@link Row} components
   *
   * **Important:**
   * 
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component.
   *
   * @param  mixed|Row $row a row content or a row component
   * @return Row wrapped row component
   */
  public function toRow($row) {
    if (!($row instanceof Row)) {
      return new Row($row);
    } else {
      return $row;
    }
  }

  /**
   * Appends a new {@link Row} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component 
   *   using {@link self::toRow()} method.
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function append($row) {
    parent::append($this->toRow($row));
    return $this;
  }

  /**
   * Prepends a new {@link Row} to the grid
   *
   * **Important!**
   *
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component 
   *   using {@link self::toRow()} method.
   * * The numeric keys of the content will be renumbered starting from zero 
   *    and the index of the prepended row is 'int(0)' 
   *
   * @param  mixed|RowInterface $row the new row or the content of the new row
   * @return self for PHP Method Chaining
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function prepend($row) {
    parent::prepend($this->toRow($row));
    return $this;
  }

  /**
   * Assigns a {@link Row} to the specified offset
   *
   * **Important!**
   *
   * * `$row` not extending {@link Row} is wrapped inside a {@link Row} component 
   *   using {@link self::toRow()} method.
   *
   * @param mixed $offset the offset to assign the value to
   * @param  mixed|RowInterface $row the new row or the content of the new row
   */
  public function offsetSet($offset, $row) {
    parent::offsetSet($offset, $this->toRow($row));
  }

  /**
   * Returns all {@link ColumnInterface} components from the grid
   * 
   * @return Container containing all the {@link ColumnInterface} components
   */
  public function getColumns() {
    return $this->getComponentsByObjectType(ColumnInterface::class);
  }

}
