<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Media;

/**
 * Description of SvgLoader
 *
 * @author samih
 */
class SvgLoader {
  //put your code here
  public static function load(string $name): string {
    return file_get_contents("sphp/svg/$name.svg", true);
  }
}
