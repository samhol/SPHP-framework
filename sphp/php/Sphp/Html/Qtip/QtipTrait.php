<?php

namespace Sphp\Html\Qtip;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QtipTrait
 *
 * @author Sami Holck
 */
trait QtipTrait {

  /**
   * Sets the value of the title attribute
   *
   * @param  string|null $qtip the value of the title attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   */
  public function setQtip($qtip) {
     $this->setAttr("title", $qtip);
     
    return $this;
  }

}
