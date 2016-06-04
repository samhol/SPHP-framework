<?php

/**
 * Bullet.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Span as Span;

/**
 * Class models a bullet for Foundation 6 orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Bullet extends AbstractComponent {

  /**
   *
   * @var int
   */
  private $number;

  /**
   *
   * @var Span
   */
  private $srDescriptor;

  /**
   *
   * @var Span
   */
  private $currentDescriptor;

  //<button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>

  public function __construct($slideNo, $slideText = null, $currentSlideText = "Current Slide") {
    $this->number = $slideNo;
    parent::__construct("button");
    //$this->content()->set("slide-text", "");
    $this->content()->set("is_current", "");
    $this->attrs()->lock("data-slide", $slideNo);
    $this->createSpans($slideText, $currentSlideText);
    //$this->createScreenReaderComponents($slideNo);
  }

  private function createSpans($slideText, $currentSlideText) {
    if ($slideText === null) {
      $slideText = "Slide " . ($this->number + 1) . ". details";
    }
    $this->srDescriptor = new Span($slideText);
    $this->srDescriptor->cssClasses()->lock("show-for-sr");
    $this->content()->set("slide-text", $this->srDescriptor);
    $this->currentDescriptor = new Span($currentSlideText);
    $this->currentDescriptor->cssClasses()->lock("show-for-sr");
    $this->content()->set("is_current", "");
    return $this;
  }

  /**
   * 
   * @param  string $description
   * @return self for PHP Method Chaining
   */
  public function setSlideDescription($description) {
    $this->srDescriptor->replaceContent($description);
    return $this;
  }

  /**
   * 
   * @param  string $description
   * @return self for PHP Method Chaining
   */
  public function setCurrentSlideDescription($description) {
    $this->currentDescriptor->replaceContent($description);
    return $this;
  }

  /**
   * 
   * @return int slide index
   */
  public function getSlideNo() {
    return $this->number;
  }

  /**
   * 
   * @param  boolean $active
   * @return self for PHP Method Chaining
   */
  public function setActive($active = true) {
    if ($active) {
      $this->content()->set("is_current", $this->currentDescriptor);
    } else {
      $this->content()->remove("is_current");
    }
    return $this;
  }

}
