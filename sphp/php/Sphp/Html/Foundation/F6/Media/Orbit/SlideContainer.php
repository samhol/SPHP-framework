<?php

/**
 * Orbit.php (UTF-8)
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
 * @deprecated since version 2.0.0
 */
class SlideContainer extends AbstractComponent {

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
  public function __construct($slides = null) {
    parent::__construct("ul");
    if ($slides !== null) {
      $this->append($slides);
    }

    $this->content()->set("slides", new \Sphp\Html\Container());
    $this->cssClasses()->lock("orbit-container");
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
   * @param  mixed|mixed[] $slide
   * @return self for PHP Method Chaining
   */
  public function append($slide) {
    if (!($slide instanceof Slide)) {
      $slide = new Slide($slide);
    }
    $this->appendSlide($slide);
    return $this;
  }

  /**
   * Appends the given slide to the orbit component
   *
   * @param  Slide $slide the slide to append
   * @return self for PHP Method Chaining
   */
  public function appendSlide(Slide $slide) {
    $this->content()->get("slides")->append($slide);
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

  /**
   * Generates a link component ponting to the OrbitSlide
   *
   * @param  string $prefix the prefix text of the buttons
   * @return Container containing the {@link Hyperlink} components
   *         pointing to the {@link Slide} objects
   */
  public function generateSlideLinks($prefix) {
    $links = new Container();
    $suffix = 0;
    foreach ($this->content() as $id => $slider) {
      $linkContent = $prefix . " " . ++$id;
      //echo ":::OrbitSlideid::: " . $id;
      $links[] = $slider->getSlideLink($linkContent);
    }
    return $links;
  }

  public function count() {
    return $this->content()->get("slides")->count();
  }

}
