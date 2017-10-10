<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Attributes\Utils;

/**
 *
 * @author samih
 */
interface AttributeValueFilterInterface {
  //put your code here
  
  public function filter($rawValue);
}
