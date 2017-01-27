<?php

/**
 * Slide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Lists\Li;

/**
 * Implements a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Slide extends Li implements SlideInterface {

  use ActivationTrait;

  /**
   * Constructs a new instance
   *
   * @param  mixed $content the content of the slide
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct($content);
    $this->cssClasses()->lock('orbit-slide');
  }

}
