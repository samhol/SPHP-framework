<?php

/**
 * SlideTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Attributes\MultiValueAttribute;

/**
 * Trait implements activation methods for orbit components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ActivationTrait {

  /**
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  abstract public function cssClasses();

  /**
   * Sets or unsets the slide component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true) {
    if ($active) {
      $this->cssClasses()->set('is-active');
    } else {
      $this->cssClasses()->remove('is-active');
    }
    return $this;
  }

  /**
   * Checks whether the slide component is set as active or not
   *
   * @return boolean true if the slide component is set as active, otherwise false
   */
  public function isActive() {
    return $this->cssClasses()->contains('is-active');
  }

}
