<?php

/**
 * Ruler.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\AbstractComponent;

/**
 * Implements a menu ruler
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Ruler extends AbstractComponent implements MenuItemInterface {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('li');
    $this->cssClasses()->lock('menu-ruler');
  }
  
  public function contentToString(): string {
    return '';
  }

}
