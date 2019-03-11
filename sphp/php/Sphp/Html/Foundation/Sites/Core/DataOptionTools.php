<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Description of DataOptionTools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DataOptionTools {

  public static function toOptionName(string $name): string {
    $dataAttrName = preg_replace('/(-[A-Za-z])/', '-$1', $name);
    if (!\Sphp\Stdlib\Strings::startsWith($dataAttrName, 'data-')) {
      $dataAttrName = "data-$dataAttrName";
    }
    return $dataAttrName;
  }

  public function parseDataName(string $name): string {
    $dataAttrName = preg_replace('/([A-Z])/', '-$1', $name);
    if (!\Sphp\Stdlib\Strings::startsWith($dataAttrName, 'data-')) {
      $dataAttrName = "data-$dataAttrName";
    }
    return $dataAttrName;
  }

}
