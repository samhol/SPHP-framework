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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Ruler extends AbstractComponent implements MenuItemInterface {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('li');
    $this->cssClasses()->protect('menu-ruler');
  }

  public function contentToString(): string {
    return '';
  }

}
