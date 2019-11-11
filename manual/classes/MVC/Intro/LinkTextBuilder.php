<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Manual\MVC\Intro;

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Tags;

/**
 * Description of LinkTextBuilder
 *
 * @author samih
 */
class LinkTextBuilder {

  /**
   * @var FontAwesome
   */
  private $fa;
  private $icon;

  public function __construct(string $icon = null) {
    $this->fa = new FontAwesome();
    $this->fa->fixedWidth(true);
    $this->setIcon($icon);
  }

  public function setIcon($icon = null) {
    $this->icon = $icon;
    return $this;
  }

  public function getIcon(): ?\Sphp\Html\Content {
    $content = null;
    if ($this->icon !== null) {
      $content = Tags::span($this->fa->createIcon($this->icon))->addCssClass('icon');
    }
    return $content;
  }

  public function build(string $package): string {
    return $this->getIcon() . Tags::span($package)->addCssClass('text');
  }

  //put your code here<?php
  //put your code here

  public function __invoke($component): string {
    return $this->build($component);
  }

}
