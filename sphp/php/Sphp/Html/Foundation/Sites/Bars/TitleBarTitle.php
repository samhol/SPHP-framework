<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Bars;

use Sphp\Html\SimpleContainerTag;

/**
 * Description of TitleBarTitle
 *
 * @author Sami Holck
 */
class TitleBarTitle extends SimpleContainerTag {

  public function __construct($content = null) {
    parent::__construct('span', $content);
    $this->cssClasses()->lock('title-bar-title');
  }

}
