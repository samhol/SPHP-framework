<?php

/**
 * DropDownMenu.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a Foundation vertical navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VerticalMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->protect('vertical');
  }

}
