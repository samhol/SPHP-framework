<?php

/**
 * Orbit.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;

/**
 * Class implements a Foundation Orbit containing {@link SlideInterface} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Orbit extends AbstractContainerComponent {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   * 
   * @param  mixed|mixed[] $slides slide(s)
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($slides = null, $ariaLabel = "") {
    parent::__construct("div");
    $this->content()->set("orbit-previous", '<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>');
    $this->content()->set("orbit-next", '<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>');
    $this->content()->set("slide-container", new SlideContainer());
    $this->content()->set("bullet-container", new BulletContainer());
    $this->cssClasses()
            ->lock("orbit");
    $this->attrs()
            ->lock("role", "region")
            ->set("aria-label", $ariaLabel)
            ->demand("data-orbit");
  }

  /**
   * 
   * @return SlideContainer 
   */
  private function slides() {
    return $this->content()->get("slide-container");
  }

  /**
   * 
   * @return BulletContainer 
   */
  private function bullets() {
    return $this->content()->get("bullet-container");
  }

  /**
   * Appends slide(s) to the orbit
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   *
   * @param  mixed|SlideInterface $slide
   * @return self for PHP Method Chaining
   */
  public function append($slide) {
    $this->slides()->append($slide);
    $n = $this->slides()->count();
    $this->bullets()->set($n - 1);
    return $this;
  }

  /**
   * Appends a new slide component to this orbit
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|mixed[] $caption the caption of the slide
   * @return self for PHP Method Chaining
   */
  public function appendFigure($img, $caption = null) {
    return $this->append(new FigureSlide($img, $caption));
  }

  /**
   * Appends a new slide component to this orbit
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|mixed[] $caption the caption of the slide
   * @return self for PHP Method Chaining
   */
  public function appendVideo($img, $caption = null) {
    return $this->append(new FigureSlide($img, $caption));
  }

  /**
   * Returns the number of the slides in this orbit
   * 
   * @return int number of the slides in this orbit
   */
  public function count() {
    return $this->slides()->count();
  }

}
