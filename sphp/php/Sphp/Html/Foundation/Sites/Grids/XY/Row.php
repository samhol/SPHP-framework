<?php

/**
 * Row.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

/**
 * Implements a row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Row extends AbstractRow {
  
  /**
   * Constructs a new instance
   *
   *
   * **Notes:**
   * 
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * 
   * @param  mixed|mixed[] $columns row columns
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($columns = null, array $sizes = null) {
    parent::__construct('div');
    if ($columns !== null) {
      $this->setColumns($columns, $sizes);
    }
  }
}
