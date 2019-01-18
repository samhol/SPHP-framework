<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Attributes\ClassAttribute;

/**
 * Trait implements activation methods for orbit components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait ActivationTrait {

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  abstract public function cssClasses(): ClassAttribute;

  /**
   * Sets or unsets the slide component as active
   *
   * @param  boolean $active true for activation and false for deactivation
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true) {
    if ($active) {
      $this->cssClasses()->add('is-active');
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
  public function isActive(): bool {
    return $this->cssClasses()->contains('is-active');
  }

}
