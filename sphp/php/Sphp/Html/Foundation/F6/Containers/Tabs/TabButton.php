<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;

/**
 * Description of TabTitle
 *
 * @author Sami Holck
 */
class TabButton extends \Sphp\Html\AbstractContainerComponent implements \Sphp\Html\Lists\LiInterface, \Sphp\Html\Attributes\AttributeChangeObserver {

  /**
   *
   * @var Tab 
   */
  private $panel;
  
  /**
   * 
   * @var Hyperlink
   */
  private $panelLink;

  /**
   * 
   * @param Tab $tabPanel
   * @param mixed $title
   */
  public function __construct(Tab $tabPanel, $title = null) {
    parent::__construct(self::TAG_NAME);
    $this->cssClasses()->lock("tabs-title");
    $this->panel = $tabPanel;
    $this->panel->getId();
    $this->panelLink = new Hyperlink("#" . $this->panel->getId(), $title);
    $this->setContentContainer($this->panelLink);
    
  }

  /**
   * 
   * @param \Sphp\Html\Attributes\AttributeChanger $obj
   * @param string $attrName
   */
  public function attributeChanged(\Sphp\Html\Attributes\AttributeChanger $obj, $attrName) {
    if ($this->panel === $obj && $attrName = "id") {
      $this->panelLink->setHref("#" . $this->panel->getId());
    }
  }

}
