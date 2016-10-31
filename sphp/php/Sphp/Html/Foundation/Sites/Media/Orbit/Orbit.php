<?php

/**
 * Orbit.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\ContentParserInterface;
use Sphp\Html\TraversableInterface;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Navigation\Nav;
use Sphp\Html\Media\VideoPlayerInterface;
use Sphp\Html\Foundation\Sites\Media\Flex;

/**
 * Class implements a Foundation Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Orbit extends AbstractComponent implements IteratorAggregate, ContentParserInterface, TraversableInterface {

  use \Sphp\Html\TraversableTrait,
      \Sphp\Html\ContentParsingTrait;

  /**
   *
   * @var Button 
   */
  private $prev;

  /**
   *
   * @var Button 
   */
  private $next;

  /**
   * the slide container
   *
   * @var Ul
   */
  private $slides;

  /**
   * the bullet container
   *
   * @var Nav 
   */
  private $bullets;

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
    parent::__construct('div');
    $this->slides = new Ul();
    $this->slides->cssClasses()
            ->lock("orbit-container");
    $this->bullets = new Nav();
    $this->bullets->cssClasses()
            ->lock("orbit-bullets");
    $this->prev = '<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>';
    $this->next = '<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>';
    $this->cssClasses()
            ->lock("orbit");
    $this->attrs()
            ->lock("role", "region")
            ->setAria("label", $ariaLabel)
            ->demand("data-orbit");
    if ($slides !== null) {
      foreach (is_array($slides) ? $slides : [$slides] as $slide) {
        $this->append($slide);
      }
    }
  }

  public function __destruct() {
    unset($this->slides, $this->bullets, $this->prev, $this->next);
    parent::__destruct();
  }

  public function __clone() {
    $this->slides = clone $this->slides;
    $this->bullets = clone $this->bullets;
    $this->prev = clone $this->prev;
    $this->next = clone $this->next;
    parent::__clone();
  }

  /**
   * 
   * @return Ul 
   */
  private function slides() {
    return $this->slides;
  }

  /**
   * 
   * @return Nav 
   */
  private function bullets() {
    return $this->bullets;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @precondition $value =&gt; 0
   * @param  bolean $autoplay true for autoplay and falseotherwise
   * @return self for PHP Method Chaining
   */
  public function autoplay($autoplay = true) {
    $this->attrs()->set("data-auto-play", $autoplay ? "true" : "false");
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @precondition $value =&gt; 0
   * @param  int $value amount of time, in ms, between slide transitions
   * @return self for PHP Method Chaining
   */
  public function setTimerDelay($value = 5000) {
    $this->attrs()->set("data-timer-delay", $value);
    return $this;
  }

  /**
   * Sets the looping on or off
   * 
   * @param  boolean $loop true for on and false for off
   * @return self for PHP Method Chaining
   */
  public function loop($loop = true) {
    $this->attrs()->set("data-infinite-wrap", $loop ? "true" : "false");
    return $this;
  }

  /**
   * Sets the Orbit to bind keyboard events to the slider, to animate frames with arrow keys
   * 
   * @param  boolean $accessible true for accessibility and false for not
   * @return self for PHP Method Chaining
   */
  public function accessibility($accessible = true) {
    $this->attrs()->set("data-accessible", $accessible ? "true" : "false");
    return $this;
  }

  /**
   * Sets the timing function to pause animation on hover
   * 
   * @param  boolean $pause true for pausing and false for not pausing
   * @return self for PHP Method Chaining
   */
  public function pauseOnHover($pause = true) {
    $this->attrs()->set("data-pause-on-hover", $pause ? "true" : "false");
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in from the left
   * 
   * @param  string $effect the transition to play when a slide comes in from the left
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimInFromLeft($effect = "fade-in") {
    $this->attrs()->set("data-anim-in-from-left", $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in from the right
   * 
   * @param  string $effect the transition to play when a slide comes in from the right
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimInFromRight($effect = "fade-in") {
    $this->attrs()->set("data-anim-in-from-right", $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in
   * 
   * @param  string $effect the transition to play when a slide comes in
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimIn($effect = "fade-in") {
    $this->setAnimInFromLeft($effect)
            ->setAnimInFromRight($effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes out from the left
   * 
   * @param  string $effect the transition to play when a slide comes out from the left
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOutFromLeft($effect = "fade-out") {
    $this->attrs()->set("data-anim-out-from-left", $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes out from the right
   * 
   * @param  string $effect the transition to play when a slide comes out from the right
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOutFromRight($effect = "fade-out") {
    $this->attrs()->set("data-anim-out-from-right", $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in
   * 
   * @param  string $effect the transition to play when a slide comes out
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOut($effect = "fade-out") {
    $this->setAnimOutFromLeft($effect)
            ->setAnimOutFromRight($effect);
    return $this;
  }

  /**
   * Sets the slide of given index active
   *
   * @param  int $index
   * @return self for PHP Method Chaining
   */
  public function setActive($index) {
    foreach ($this->slides as $no => $slide) {
      if ($no == $index) {
        $slide->setActive(true);
      } else {
        $slide->setActive(false);
      }
    }
    foreach ($this->bullets as $no => $bullet) {
      if ($no == $index) {
        $bullet->setActive(true);
      } else {
        $bullet->setActive(false);
      }
    }
    return $this;
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
    if (!($slide instanceof SlideInterface)) {
      $slide = new Slide($slide);
    }
    $this->slides()->append($slide);
    $n = $this->slides()->count();
    $this->bullets()->append(new Bullet($n - 1));
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
   * @param  VideoPlayerInterface|FlexVideo $player the image path or the image component
   * @return self for PHP Method Chaining
   */
  public function appendIframe($player) {
    return $this->append(new FlexSlide($player));
  }

  /**
   * Appends a new slide component containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return self for PHP Method Chaining
   */
  public function appendYoutubeVideo($videoId, $isPlaylist = false) {
    return $this->appendIframe(Flex::youtube($videoId, $isPlaylist));
  }

  /**
   * Appends a new slide component containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return self for PHP Method Chaining
   */
  public function appendVimeoVideo($videoId) {
    return $this->appendIframe(Flex::vimeo($videoId));
  }

  /**
   * Appends a new slide component containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return self for PHP Method Chaining
   */
  public function appendDailymotionVideo($videoId) {
    return $this->appendIframe(Flex::dailymotion($videoId));
  }

  /**
   * Returns the number of the slides in this orbit
   * 
   * @return int number of the slides in this orbit
   */
  public function count() {
    return $this->slides()->count();
  }

  public function getIterator() {
    return $this->slides()->getIterator();
  }

  public function contentToString() {
    return $this->prev . $this->next . $this->slides . $this->bullets;
  }

}
