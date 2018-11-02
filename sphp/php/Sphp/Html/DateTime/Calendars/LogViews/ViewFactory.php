<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Media\Icons\Svg;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;

/**
 * Description of FlagView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ViewFactory {

  public static function flag(string $country): string {
    return '<span class="flag">' . Svg::fromUrl('http://data.samiholck.com/svg/flags/finland.svg') . "</span>";
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @return string
   */
  public static function birthDay(BirthDay $date, \Sphp\DateTime\Date $curr): string {
    $output = "Birthday of {$date->getName()}";
    $year = $curr->getYear();
    var_dump($year);
    $age = $year - $date->getYear();
    if ($age === 0) {
      $output .= " (was born this day)";
    } else {
      $output .= " (was born $age years ago)";
    }
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($date->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($date->isFlagDay()) {
      $output .= ViewFactory::flag('finland');
    }
    return $output;
  }

}
