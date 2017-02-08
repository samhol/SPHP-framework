<?php

/**
 * TitleBar.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Implements a Title Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-11-21
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/topbar.html Foundation Top Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TitleBar extends AbstractBar {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div', new TitleBarContentArea('left'), new TitleBarContentArea('right'));
    $this->cssClasses()->lock('title-bar');
  }

}
