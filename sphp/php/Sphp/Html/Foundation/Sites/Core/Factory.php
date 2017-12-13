<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Span;

/**
 * Description of Factory
 *
 * @author samih
 */
class Factory {

  //put your code here
  public static function ScreenReaderLabel(string $text = null): Span {
    $label = new Span($text);
    $label->cssClasses()->protect('show-for-sr');
    return $label;
  }

}
