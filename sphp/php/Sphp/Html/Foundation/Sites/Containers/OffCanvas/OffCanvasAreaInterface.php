<?php

/**
 * OffCanvasAreaInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\ComponentInterface;

/**
 * Defines the basic requirements of a Foundation offcanvas area
 * 
 * Implementation is a panel that slides in and out of the {@link OffCanvas} when activated. 
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/offcanvas.html Foundation Off-canvas
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface OffCanvasAreaInterface extends ComponentInterface {

  /**
   * Creates an opener for the off canvas component
   * 
   * @param mixed $button the button content
   * @return OffCanvasOpener for the off canvas component
   */
  //public function getMenuButton($button = null);
}
