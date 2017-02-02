<?php

/**
 * BarContentArea.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\Foundation\Sites\Buttons\MenuButton;

/**
 * Implements a Title Bar contetn area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class LeftBarContentArea extends BarContentArea {

  /**
   * Constructs a new instance
   *
   * @param mixed $side the title of the Top Bar component
   */
  public function __construct() {
    parent::__construct();
    $this->cssClasses()->lock("title-bar-left");
  }


  public function contentToString() {
    return $this->getMenuButton() . parent::contentToString();
  }

}
