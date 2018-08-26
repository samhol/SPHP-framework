<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Component;

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
interface OffCanvasAreaInterface extends Component {

  /**
   * Creates an opener for the off canvas component
   * 
   * @param mixed $button the button content
   * @return OffCanvasOpener for the off canvas component
   */
  //public function getMenuButton($button = null);
}
