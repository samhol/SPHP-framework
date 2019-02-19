<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Bars;

/**
 * Description of TitleBarFactory
 *
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/kitchen-sink.html#title-bar Foundation Title Bar
 * @license https://opensource.org/licenses/MIT The MIT License
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
