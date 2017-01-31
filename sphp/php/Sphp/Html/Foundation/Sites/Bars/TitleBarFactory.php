<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Description of TitleBarFactory
 *
 * @author Sami Holck
 */
class TitleBarFactory {

  public static function create(array $data) {
    $titleBar = new TitleBar();
    if (array_key_exists('l', $data)) {
      $titleBar->left(static::insert($data['l']));
    }
    if (array_key_exists('r', $data)) {
      $titleBar->left(static::insert($data['r']));
    }
  }

  public static function insert(array $data, $side) {
    $cont = new BarContentArea($side);
    foreach ($data as $k => $v) {
      if ($k === 'title') {
        $cont->appendTitle($v);
      } else {
        $cont->append($v);
      }
    }
    return $cont;
  }

}
