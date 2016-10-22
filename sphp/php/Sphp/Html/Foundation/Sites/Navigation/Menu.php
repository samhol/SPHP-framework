<?php

/**
 * Menu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Class implements a Dropown menu for Foundation Top Bar navigation menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Menu extends AbstractMenu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = NULL) {
    parent::__construct('ul');
    if ($content !== NULL) {
      $this->append($content);
    }
  }

}
