<?php

/**
 * DrilldownMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Drilldown menu 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
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
  public function __construct($content = NULL) {
    parent::__construct($content);
    $this->vertical(true);
    $this->attrs()->demand('data-drilldown');
  }

  /**
   * {@inheritdoc}
   */
  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->vertical(true);
    }
    parent::append($content);
    return $this;
  }

}
