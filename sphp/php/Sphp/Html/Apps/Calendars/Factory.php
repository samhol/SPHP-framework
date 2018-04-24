<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Apps\Calendars;

/**
 * Description of Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Factory {

  public static function getMonth(int $month, int $year = null): MonthView {
    if ($year === null) {
      $year = date('Y');
    }
    return new MonthView($year, $month);
  }

}
