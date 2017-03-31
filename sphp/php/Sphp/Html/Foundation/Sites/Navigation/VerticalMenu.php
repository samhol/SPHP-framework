<?php

/**
 * DropDownMenu.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Implements a vertical navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
    $this->cssClasses()->lock('vertical');
  }

}
