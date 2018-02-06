<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Core;
use Sphp\Html\TagFactory;
use Sphp\Html\Span;

/**
 * Description of Factory
 *
 * @author samih
 */
class Factory {

  //put your code here
  public static function screenReaderLabel(string $text = null, string $tag = 'span'): Span {
    $label = new Span($text);
    $label = TagFactory::$tag($text);
    $label->cssClasses()->protect('show-for-sr');
    return $label;
  }

}
