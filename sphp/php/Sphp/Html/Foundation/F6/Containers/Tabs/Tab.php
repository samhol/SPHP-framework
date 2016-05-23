<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

/**
 * Description of TabPanel
 *
 * @author Sami Holck
 */
class Tab extends \Sphp\Html\AbstractContainerTag {
  
  /**
   *
   * @var TabButton 
   */
  private $tabButton;
  /**
   * 
   * @param mixed $content
   */
  public function __construct($tab = null, $content = null) {
    parent::__construct("div");
    $this->identify();
    $this->cssClasses()->lock("tabs-panel");
    if ($content !== null) {
      $this->append($content);
    }
    $this->tabButton = new TabButton($this, $tab);
  }
  
  /**
   * 
   * @param  mixed $title
   * @return TabButton
   */
  public function getTabButton() {
    return $this->tabButton;
    
  }
}
