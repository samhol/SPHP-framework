<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Head;

/**
 * Description of Container
 *
 * @author samih
 */
class Container implements \Iterator, \Sphp\Html\Content {
  //put your code here
  
  private $important;
  
  private $links;
  
  private $scripts;
  
  private $sequence;
  
  public function __construct() {
    ;
  }
  
  
}
