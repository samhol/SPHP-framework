<?php

/**
 * OffCanvasOpener.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\AbstractComponent;

/**
 * Class MenuOpenerButton
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuButton extends AbstractComponent {

  /**
   * 
   * @param OffCanvasAreaInterface $offCanvas the off-canvas component or its id
   * @param string $screenReaderText
   */
  public function __construct() {
    parent::__construct('button');
    $this->cssClasses()->lock('menu-icon');
  }

  public function contentToString(): string {
    return '';
  }

}
