<?php

/**
 * OrbitContainer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Container as Container;

/**
 * Class implements a Foundation Orbit containing {@link Slide} components
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Orbit slider
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Orbit extends AbstractComponent {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   * <div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
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
   * @param  mixed|mixed[] $slides
   * @return self for PHP Method Chaining
   */
  public function append($slides) {
    foreach (is_array($slides) ? $slides : [$slides] as $slide) {
      if (!($slide instanceof Slide)) {
        $slide = new Slide($slide);
      }
      $this->appendSlide($slide);
    }
    return $this;
  }

  /**
   * Appends the given slide to the orbit component
   *
   * @param  Slide $slide the slide to append
   * @return self for PHP Method Chaining
   */
  public function appendSlide(Slide $slide) {
    $this->slides()->append($slide);
    $n = $this->slides()->count();
    $this->bullets()->set($n - 1);
    return $this;
  }

  /**
   * Appends a new slide component to the orbit component
   *
   * **Important!**
   *
   * Parameter <var>mixed $content</var> & <var>mixed $caption</var> can be of
   * any type that converts to a string. So also an object of any class that
   * implements magic method `__toString()` is allowed.
   *
   * @param  mixed|mixed[] $content the content of the slide
   * @param  mixed|mixed[] $caption the caption of the slide
   * @return self for PHP Method Chaining
   */
  public function appendNewSlide($content, $caption = null) {
    return $this->appendSlide(new Slide($content, $caption));
  }

  public function count() {
    return $this->slides()->count();
  }

}
