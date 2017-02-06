<?php

/**
 * TitleBarFactory.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Description of TitleBarFactory
 *
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/kitchen-sink.html#title-bar Foundation Title Bar
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
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
