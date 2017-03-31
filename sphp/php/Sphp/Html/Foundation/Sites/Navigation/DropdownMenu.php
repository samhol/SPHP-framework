<?php

/**
 * DropdownMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Dropown menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DropdownMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock('dropdown');
    $this->attrs()->demand('data-dropdown-menu');
  }

  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->addCssClass('is-dropdown-submenu-parent');
    }
    parent::append($content);
    return $this;
  }

}
