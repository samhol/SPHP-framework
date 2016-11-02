<?php

/**
 * MouseCoordinateViewer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractJavaScriptComponent;

/**
 * Class MouseCoordinateViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MouseCoordinatesViewer extends AbstractJavaScriptComponent {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->lock("sphp-MouseCoordinatesViewer");
    $this->getInnerContainer()->append('<span class="fi-icon fi-paw font-size-36"></span>'
            . '<div>x:<span class="x">0</span>px</div>'
            . '<div>y:<span class="y">0</span>px</div>');
  }

}
