<?php

/**
 * SlideInterface.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Lists\LiInterface;

/**
 * Defines a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface SlideInterface extends LiInterface {

  /**
   * Sets the slide as active or not
   * 
   * @param  boolean $active true for active and false for inactive
   * @return $this for a fluent interface
   */
  public function setActive($active = true);

  /**
   * Checks whether the slide component is set as active or not
   *
   * @return boolean true if the slide component is set as active, otherwise false
   */
  public function isActive();
}
