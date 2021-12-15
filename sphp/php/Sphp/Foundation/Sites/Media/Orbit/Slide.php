<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Media\Orbit;

/**
 * Defines a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Slide {

  /**
   * Sets the slide as active or not
   * 
   * @param  bool $active true for active and false for inactive
   * @return $this for a fluent interface
   */
  public function setActive(bool $active = true);

  /**
   * Checks whether the slide component is set as active or not
   *
   * @return bool true if the slide component is set as active, otherwise false
   */
  public function isActive(): bool;
}
