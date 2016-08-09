<?php

/**
 * OffCanvasAreaInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers\OffCanvas;

use Sphp\Html\ComponentInterface as ComponentInterface;

/**
 * Interface specifies the basic requirements of a Foundation 6 offcanvas area
 * 
 * {@link self} is the panel that slides in and out of the {@link OffCanvas} when activated. 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-09-15
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/offcanvas.html Foundation Off-canvas
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface OffCanvasAreaInterface extends ComponentInterface {

  /**
   * Creates an opener for the off canvas component
   * 
   * @param mixed $button the button content
   * @return OffCanvasOpener for the off canvas component
   */
  public function getMenuButton($button = null);
}