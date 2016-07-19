<?php

/**
 * SlideInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Lists\LiInterface as LiComponent;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SlideInterface extends LiComponent {

  /**
   * Sets the slide as active or not
   * 
   * @param  boolean $active true for active and false for inactive
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true);

  /**
   * Checks whether the slide component is set as active or not
   *
   * @return boolean true if the slide component is set as active, otherwise false
   */
  public function isActive();
}
