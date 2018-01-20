<?php

/**
 * Orbit.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;

/**
 * Implements a Foundation framework based Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Orbit extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var Button 
   */
  private $prev;

  /**
   * @var Button 
   */
  private $next;

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
   * Constructs a new instance
   *
   * @param  string|null $ariaLabel optional Aria label text
   */
  public function __construct(string $ariaLabel = null) {
    parent::__construct('div');
    $this->slides = new SlideContainer();
    $this->prev = '<button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>';
    $this->next = '<button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>';
    $this->cssClasses()
            ->protect('orbit');
    $this->attributes()
            ->protect('role', 'region')
            ->setAria('label', $ariaLabel)
            ->demand('data-orbit');
  }

  public function __destruct() {
    unset($this->slides, $this->prev, $this->next);
    parent::__destruct();
  }

  public function __clone() {
    $this->slides = clone $this->slides;
    $this->prev = clone $this->prev;
    $this->next = clone $this->next;
    parent::__clone();
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
   * @precondition $value =&gt; 0
   * @param  bolean $visible true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function showBullets($visible = true) {
    $this->bulletsVisible = (boolean) $visible;
    if ($this->bulletsVisible) {
      $this->attributes()->set('data-bullets', 'true');
    } else {
      $this->attributes()->set('data-bullets', 'false');
    }
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @precondition $value =&gt; 0
   * @param  bolean $visible true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function showNavigationButtons($visible = true) {
    $this->navButtonsVisible = (boolean) $visible;
    if ($this->navButtonsVisible) {
      $this->attributes()->set('data-nav-buttons', 'true');
    } else {
      $this->attributes()->set('data-nav-buttons', 'false');
    }
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @param  bolean $autoplay true for autoplay and false otherwise
   * @return $this for a fluent interface
   */
  public function autoplay($autoplay = true) {
    $this->attributes()->set('data-auto-play', $autoplay ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the amount of time, in ms, between slide transitions
   * 
   * @precondition $value =&gt; 0
   * @param  int $value amount of time, in ms, between slide transitions
   * @return $this for a fluent interface
   */
  public function setTimerDelay($value = 5000) {
    $this->attributes()->set('data-timer-delay', $value);
    return $this;
  }

  /**
   * Sets the looping on or off
   * 
   * @param  boolean $loop true for on and false for off
   * @return $this for a fluent interface
   */
  public function loop($loop = true) {
    $this->attributes()->set('data-infinite-wrap', $loop ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the Orbit to bind keyboard events to the slider, to animate frames with arrow keys
   * 
   * @param  boolean $accessible true for accessibility and false for not
   * @return $this for a fluent interface
   */
  public function accessibility($accessible = true) {
    $this->attributes()->set('data-accessible', $accessible ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the timing function to pause animation on hover
   * 
   * @param  boolean $pause true for pausing and false for not pausing
   * @return $this for a fluent interface
   */
  public function pauseOnHover($pause = true) {
    $this->attributes()->set('data-pause-on-hover', $pause ? 'true' : 'false');
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in from the left
   * 
   * @param  string $effect the transition to play when a slide comes in from the left
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimInFromLeft($effect = 'fade-in') {
    $this->attributes()->set('data-anim-in-from-left', $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in from the right
   * 
   * @param  string $effect the transition to play when a slide comes in from the right
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimInFromRight($effect = 'fade-in') {
    $this->attributes()->set('data-anim-in-from-right', $effect);
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
  public function setAnimIn($effect = 'fade-in') {
    $this->setAnimInFromLeft($effect)
            ->setAnimInFromRight($effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes out from the left
   * 
   * @param  string $effect the transition to play when a slide comes out from the left
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOutFromLeft($effect = 'fade-out') {
    $this->attributes()->set('data-anim-out-from-left', $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes out from the right
   * 
   * @param  string $effect the transition to play when a slide comes out from the right
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOutFromRight($effect = "fade-out") {
    $this->attributes()->set('data-anim-out-from-right', $effect);
    return $this;
  }

  /**
   * Sets the transition to play when a slide comes in
   * 
   * @param  string $effect the transition to play when a slide comes out
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/orbit.html#using-animation
   * @link   http://foundation.zurb.com/sites/docs/motion-ui.html Foundation Motion UI
   */
  public function setAnimOut($effect = 'fade-out') {
    $this->setAnimOutFromLeft($effect)
            ->setAnimOutFromRight($effect);
    return $this;
  }

  /**
   * Sets the slide of given index active
   *
   * @param  int $index
   * @return $this for a fluent interface
   */
  public function setActive($index) {
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
    $output .= $this->prev . $this->next . $this->slides;
    $output .= '</div>';
    if ($this->bulletsVisible) {
      $output .= $this->slides()->generateBullets();
    }
    return $output;
  }

}
