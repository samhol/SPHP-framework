<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Implements a Foundation framework based XY Grid container for rows
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license https://opensource.org/licenses/MIT The MIT License
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
