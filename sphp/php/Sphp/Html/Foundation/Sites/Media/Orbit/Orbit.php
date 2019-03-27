<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Foundation\Sites\Core\JavaScript\AbstractJavaScriptComponent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;

/**
 * Implements a Foundation framework based Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Orbit extends AbstractJavaScriptComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var boolean 
   */
  private $navButtonsVisible = true;

  /**
   * the slide container
   *
   * @var SlideContainer
   */
  private $slides;

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
    parent::__construct('div');
    $this->slides = new SlideContainer();
    $this->cssClasses()
            ->protectValue('orbit');
    $this->attributes()
            ->protect('role', 'region')
            ->setAria('label', $ariaLabel)
            ->demand('data-orbit');
  }

  public function __destruct() {
    unset($this->slides, $this->options);
    parent::__destruct();
  }

  public function __clone() {
    $this->slides = clone $this->slides;
    parent::__clone();
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
   * 
   * @return SlideContainer 
   */
  public function slides(): SlideContainer {
    return $this->slides;
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
   * @param  boolean $loop true for on and false for off
   * @return $this for a fluent interface
   */
  public function loop(bool $loop = true) {
    $this->setOption('data-infinite-wrap', $loop);
    return $this;
  }

  /**
   * Sets the Orbit to bind keyboard events to the slider, to animate frames with arrow keys
   * 
   * @param  boolean $accessible true for accessibility and false for not
   * @return $this for a fluent interface
   */
  public function accessibility(bool $accessible = true) {
    $this->setOption('data-accessible', $accessible);
    return $this;
  }

  /**
   * Sets the timing function to pause animation on hover
   * 
   * @param  boolean $pause true for pausing and false for not pausing
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
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
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
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
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
    return $this->slides()->count();
  }

  public function getIterator(): \Traversable {
    return $this->slides()->getIterator();
  }

  public function contentToString(): string {
    $output = '<div class="orbit-wrapper">';
    $output .= $this->createOrbitConrols() . $this->slides;
    $output .= '</div>';
    if ($this->bulletsVisible) {
      $output .= $this->slides()->generateBullets();
    }
    return $output;
  }

}
