<?php

/**
 * BlockGridColumn.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;

/**
 * Class BlockGridColumn
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BlockGridColumn extends AbstractContainerTag {

  public function __construct($content = null) {
    parent::__construct("div");
    $this->cssClasses()->lock("column");
    if ($content !== null) {
      $this->append($content);
    }
  }

}
