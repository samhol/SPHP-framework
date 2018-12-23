<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Tables;

/**
 * Description of Tables
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class Tables {
  
  public function rowsFromArray(array $arr) {
    foreach ($arr as $tr) {
      if (!($tr instanceof RowInterface)) {
        $this->append(Tr::fromThs($tr));
      }
    }
    return $this;
  }
}
