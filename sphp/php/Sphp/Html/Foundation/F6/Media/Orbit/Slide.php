<?php

/**
 * Slide.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Slide extends AbstractSlide {

  /**
   * Set the content of the slide
   *
   * **Important!**
   *
   * Parameter <var>mixed $content</var> can be of any type
   * that converts to a string. So also an object of any class that implements
   * magic method `__toString()` is allowed.
   *
   * @param  mixed $content the content of the slide
   * @return self for PHP Method Chaining
   */
  public function setContent($content) {
    $this->content()->clear()->append($content);
    return $this;
  }

}
