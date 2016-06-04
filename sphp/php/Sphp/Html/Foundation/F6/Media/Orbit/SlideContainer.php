<?php

/**
 * SlideContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Container as Container;

/**
 * Class implements a Foundation Orbit containing {@link Slide} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SlideContainer extends AbstractComponent {

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct("ul");
    $this->cssClasses()->lock("orbit-container");
  }

  /**
   * Appends a slide to the container
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   *
   * @param  mixed|SlideInterface $slide
   * @return self for PHP Method Chaining
   */
  public function append($slide) {
    if (!($slide instanceof Slide)) {
      $slide = new Slide($slide);
    }
    $this->content()->append($slide);
    return $this;
  }

  /**
   * Appends a new image slide component to the container
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|mixed[] $caption the caption of the slide
   * @return self for PHP Method Chaining
   */
  public function appendFigure($img, $caption = null) {
    $this->append(new FigureSlide($img, $caption));
    return $this;
  }

  /**
   * Returns the number of the slides in the container
   * 
   * @return int number of the slides in the container
   */
  public function count() {
    return $this->content()->count();
  }

}
