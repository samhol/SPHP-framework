<?php

/**
 * DrilldownMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Drill down menu 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DrilldownMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->vertical(true);
    $this->attributes()->demand('data-drilldown');
  }

  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->vertical(true);
    }
    parent::append($content);
    return $this;
  }

}
