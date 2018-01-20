<?php

/**
 * Bullet.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Span;

/**
 * Implements a bullet for Foundation framework based Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Foundation Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Bullet extends AbstractComponent {

  use ActivationTrait;

  /**
   * @var int
   */
  private $number;

  /**
   * @var Span
   */
  private $srDescriptor;

  /**
   * @var Span
   */
  private $currentDescriptor;

  /**
   * Constructs a new instance
   * 
   * @param int $slideNo
   * @param string $slideText
   * @param string $currentSlideText
   */
  public function __construct(int $slideNo, $slideText = null, $currentSlideText = 'Current Slide') {
    $this->number = $slideNo;
    parent::__construct('button');
    $this->attributes()->protect('data-slide', $slideNo);
    $this->createSpans($slideText, $currentSlideText);
  }

  /**
   * 
   * @param  string $slideText
   * @param  type $currentSlideText
   * @return $this for a fluent interface
   */
  private function createSpans($slideText, $currentSlideText) {
    if ($slideText === null) {
      $slideText = "Slide " . ($this->number + 1) . ". details";
    }
    $this->srDescriptor = new Span($slideText);
    $this->srDescriptor->cssClasses()->protect('show-for-sr');
    $this->currentDescriptor = new Span($currentSlideText);
    $this->currentDescriptor->cssClasses()->protect('show-for-sr');
    return $this;
  }

  /**
   * 
   * @param  string $description
   * @return $this for a fluent interface
   */
  public function setSlideDescription(string $description) {
    $this->srDescriptor->replaceContent($description);
    return $this;
  }

  /**
   * 
   * @param  string $description
   * @return $this for a fluent interface
   */
  public function setCurrentSlideDescription(string $description) {
    $this->currentDescriptor->replaceContent($description);
    return $this;
  }

  /**
   * Returns the slide index
   * 
   * @return int slide index
   */
  public function getSlideNo(): int {
    return $this->number;
  }

  public function contentToString(): string {
    $content = $this->srDescriptor;
    if ($this->isActive()) {
      $content .= $this->currentDescriptor;
    }
    return $content;
  }

}
