<?php

/**
 * Bullet.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Span;

/**
 * Class models a bullet for Foundation orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Bullet extends AbstractComponent {
  
  use ActivationTrait;

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

  /**
   * Constructs a new instance
   * 
   * @param int $slideNo
   * @param string $slideText
   * @param string $currentSlideText
   */
  public function __construct($slideNo, $slideText = null, $currentSlideText = 'Current Slide') {
    $this->number = $slideNo;
    parent::__construct('button');
    //$this->content()->set("slide-text", "");
    //$this->content()->set("is_current", "");
    $this->attrs()->lock('data-slide', $slideNo);
    $this->createSpans($slideText, $currentSlideText);
    //$this->createScreenReaderComponents($slideNo);
  }

  /**
   * 
   * @param string $slideText
   * @param type $currentSlideText
   * @return self for PHP Method Chaining
   */
  private function createSpans($slideText, $currentSlideText) {
    if ($slideText === null) {
      $slideText = "Slide " . ($this->number + 1) . ". details";
    }
    $this->srDescriptor = new Span($slideText);
    $this->srDescriptor->cssClasses()->lock('show-for-sr');
    //$this->content()->set("slide-text", $this->srDescriptor);
    $this->currentDescriptor = new Span($currentSlideText);
    $this->currentDescriptor->cssClasses()->lock('show-for-sr');
    //$this->content()->set("is_current", "");
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
   * Returns the slide index
   * 
   * @return int slide index
   */
  public function getSlideNo() {
    return $this->number;
  }

  public function contentToString() {
    $content = $this->srDescriptor;
    if ($this->isActive()) {
      $content .= $this->currentDescriptor;
    }
    return $content;
  }

}
