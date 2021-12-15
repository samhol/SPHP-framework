<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Carousel;

use IteratorAggregate;
use Sphp\Html\AbstractContent;
use Sphp\Html\Div;
use Sphp\Html\Forms\Buttons\Button;

/**
 * Implements a Foundation framework based Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Carousel extends AbstractContent implements IteratorAggregate {

  private Div $carousel;
  private Div $slides;
  private Button $prev;
  private Button $next;

  /**
   * @var boolean 
   */
  private $navButtonsVisible = true;

  /**
   * @var boolean 
   */
  private $bulletsVisible = true;

  /**
   * Constructor
   *
   * @param  string|null $ariaLabel optional Aria label text
   */
  public function __construct(string $ariaLabel = null) {
    $this->carousel = new Div();
    $this->carousel->addCssClass('carousel slide');
    $this->carousel->setAttribute('data-bs-ride', 'carousel');
    $this->carousel->identify();
    $this->slides = new Div();
    $this->slides->addCssClass('carousel-inner');
    $this->carousel->append($this->slides);
    $this->generateButtons();
  }

  public function __destruct() {
    unset($this->slides, $this->options);
  }

  public function __clone() {
    $this->slides = clone $this->slides;
    parent::__clone();
  }

  public function generateButtons() {
    $this->prev = new Button();
    $this->prev->addCssClass("carousel-control-prev");
    $this->prev
            ->setAttribute('data-bs-target', "#{$this->carousel->identify()}")
            ->setAttribute('data-bs-slide', 'prev');
    $this->prev->append('<span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>');
    $this->carousel->append($this->prev);
  }

  public function createOrbitConrols() {
    $controArea = new \Sphp\Html\Div();
    $controArea->addCssClass('orbit-controls');
    $prev = '<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>';
    $next = '<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>';
    $controArea->append($prev);
    $controArea->append($next);
    return $controArea;
  }

  /**
   * Appends a slide to the orbit
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   *
   * @param  mixed|Slide $slide
   * @return Slide appended instance
   */
  public function appendSlide($slide): Slide {
    if (!($slide instanceof Slide)) {
      $slide = new BasicSlide($slide);
    }
    $this->slides->append($slide);
    return $slide;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @param  bolean $visible true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function showBullets(bool $visible = true) {
    $this->bulletsVisible = (boolean) $visible;
    if ($this->bulletsVisible) {
      $this->setOption('data-bullets', 'true');
    } else {
      $this->setOption('data-bullets', 'false');
    }
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @param  bolean $visible true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function showNavigationButtons(bool $visible = true) {
    $this->navButtonsVisible = (boolean) $visible;
    if ($this->navButtonsVisible) {
      $this->setOption('data-nav-buttons', 'true');
    } else {
      $this->setOption('data-nav-buttons', 'false');
    }
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @param  bolean $autoplay true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function autoplay(bool $autoplay = true) {
    $this->setOption('data-auto-play', $autoplay);
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @precondition $value =&gt; 0
   * @param  int $value amount of time, in ms, between slide transitions
   * @return $this for a fluent interface
   */
  public function setTimerDelay(int $value = null) {
    $this->setOption('data-timer-delay', $value);
    return $this;
  }

  /**
   * Sets the looping on or off
   * 
   * @param  bool $loop true for on and false for off
   * @return $this for a fluent interface
   */
  public function loop(bool $loop = true) {
    $this->setOption('data-infinite-wrap', $loop);
    return $this;
  }

  /**
   * Sets the Orbit to bind keyboard events to the slider, to animate frames with arrow keys
   * 
   * @param  bool $accessible true for accessibility and false for not
   * @return $this for a fluent interface
   */
  public function accessibility(bool $accessible = true) {
    $this->setOption('data-accessible', $accessible);
    return $this;
  }

  /**
   * Sets the timing function to pause animation on hover
   * 
   * @param  bool $pause true for pausing and false for not pausing
   * @return $this for a fluent interface
   */
  public function pauseOnHover(bool $pause = true) {
    $this->setOption('data-pause-on-hover', $pause);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in
   * 
   * @param  string $effect the transition to play when a slide comes in
   * @return $this for a fluent interface
   * @link   https://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   https://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimIn(string $effect = null) {
    $this->setOption('data-anim-in-from-left', $effect);
    $this->setOption('data-anim-in-from-right', $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide goes out
   * 
   * @param  string $effect the transition to play when a slide goes out
   * @return $this for a fluent interface
   * @link   https://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   https://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOut(string $effect = null) {
    $this->setOption('data-anim-out-to-left', $effect);
    $this->setOption('data-anim-out-to-right', $effect);
    return $this;
  }

  /**
   * Sets the slide of given index active
   *
   * @param  int $index
   * @return $this for a fluent interface
   */
  public function setActive(int $index) {
    $this->slides()->setActive($index);
    return $this;
  }

  /**
   * Returns the number of the slides in this orbit
   * 
   * @return int number of the slides in this orbit
   */
  public function count(): int {
    return $this->slides->count();
  }

  public function getArrowButtons() {
    return '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>';
  }

  public function getIterator(): \Traversable {
    return $this->slides->getIterator();
  }

  
  private function forceActive() {
    $valid = false;
    foreach ($this->slides as $k =>$value) {
      if($value->isActive()) {
        $valid = true;
        break;
      }
    }
    if(!$valid) {
      $this->slides->getIterator()[0]->setActive();
    }
  }
  public function getHtml(): string {
    $output = '<div class="carousel-inner">';
    $output .= $this->slides;
    $output .= '</div>';
    if ($this->bulletsVisible) {
      // $output .= $this->slides()->generateBullets();
    }
    $this->forceActive();
    return $this->carousel->getHtml();
  }

}
