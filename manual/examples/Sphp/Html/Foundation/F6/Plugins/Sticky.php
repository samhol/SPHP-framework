<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\F6\Plugins;

/**
 * Description of Sticky
 *
 * @author samih_000
 */
class Sticky extends \Sphp\Html\AbstractSimpleContainerTag  {
  //put your code here
  
  /**
   * 
   * @param type $content
   */
  public function __construct($content) {
    parent::__construct("div", $content, $contentContainer);
  }
  
  
}
