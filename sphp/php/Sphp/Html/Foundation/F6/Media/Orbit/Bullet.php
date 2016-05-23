<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

/**
 * Description of OrbitButton
 *
 * @author samih_000
 */
class Bullet extends \Sphp\Html\AbstractComponent {
  private $number;
  
  //<button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>

  public function __construct($slideNo) {
    $this->number = $slideNo;
    parent::__construct("button");
    $this->content()->set("slide-text", "");
    $this->content()->set("is_current", "");
    $this->attrs()->lock("data-slide", $slideNo);
    $this->createScreenReaderComponents($slideNo);
  }
  
  private function createScreenReaderComponents($slideNo) {
    $span = new \Sphp\Html\Span("Slide $slideNo details");
    $span->cssClasses()->lock("show-for-sr");
    $this->content()->set("slide-text", $span);
    return $this;
  }


  public function getSlideNo() {
    return $this->number;
  }
  
  public function setActive($active = true) {
    if ($active) {
     $this->content()->set("is_current", '<span class="show-for-sr">Current Slide</span>');
    } else {
     $this->content()->remove("is_current");
    }
    return $this;
  }
  
}
