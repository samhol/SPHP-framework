<?php

/**
 * BlockGridColumn.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\Div;

/**
 * Implements a Block Grid Column
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html#block-grids Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGridColumn extends Div implements BlockGridColumnInterface {

  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock(['column', 'column-block']);
  }

}
