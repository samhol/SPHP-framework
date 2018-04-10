<?php

/**
 * Menu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a basic navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/menu.html Foundation Menu
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Menu extends AbstractMenu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct('ul');
    if ($content !== null) {
      $this->appendContent($content);
    }
  }

  /**
   * 
   * @param mixed $content
   */
  protected function appendContent($content) {
    foreach (is_array($content) ? $content : [$content] as $item) {
      if ($item instanceof MenuItemInterface) {
        $this->append($item);
      } else {
        $this->appendText($item);
      }
    }
  }

}
