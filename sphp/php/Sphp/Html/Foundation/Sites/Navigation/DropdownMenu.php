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
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $this->cssClasses()->protect('dropdown');
    $this->attributes()->demand('data-dropdown-menu');
  }

  public function append(MenuItemInterface $content) {
    if ($content instanceof SubMenu) {
      $content->addCssClass('sphp-hide-fouc-on-load');
    }
    parent::append($content);
    return $this;
  }

}
