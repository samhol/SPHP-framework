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
 * Implements an XY Grid container
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DivGrid extends AbstractGrid {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
  }

  /**
   * 
   * @param  array $rows single or two dimensional array of column data
   * @return DivGrid new instance containing given content as rows
   */
  public static function from(array $rows): DivGrid {
    $grid = new Static();
    foreach ($rows as $row) {
      $grid->append($row);
    }
    return $grid;
  }

}
