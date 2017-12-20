<?php

/**
 * Grid.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Implements a Foundation framework based XY Grid container for rows
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Grid extends AbstractGrid {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
  }

  /**
   * 
   * @param  array $rows single or two dimensional array of column data
   * @return Grid new instance containing given content as rows
   */
  public static function from(array $rows): Grid {
    $grid = new Static();
    foreach ($rows as $row) {
      $grid->append($row);
    }
    return $grid;
  }

}
