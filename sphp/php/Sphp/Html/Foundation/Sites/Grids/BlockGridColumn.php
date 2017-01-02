<?php

/**
 * BlockGridColumn.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Div;

/**
 * Implements a Foundation Block Grid Column
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-26
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGridColumn extends Div implements BlockGridColumnInterface {

  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock('column');
  }

}
