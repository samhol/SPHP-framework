<?php

/**
 * MagellanMenu.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

/**
 * Class MagellanMenu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-14
 * @link    http://foundation.zurb.com/ Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MagellanMenu extends Menu {

  /**
   * Constructs a new instance
   *
   * @param mixed $content
   */
  public function __construct($content = NULL) {
    parent::__construct($content);
    $this->attrs()->demand('data-magellan');
  }

}
