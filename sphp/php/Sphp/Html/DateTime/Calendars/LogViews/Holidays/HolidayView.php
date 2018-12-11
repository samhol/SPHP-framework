<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;

/**
 * Description of HolidayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayView {

  /**
   * Implements function call
   * 
   * @param  Holiday $holiday
   * @return string
   */
  public function __invoke(Holiday $holiday): string {
    return $this->build($holiday);
  }

  /**
   * Creates a section containing holidays (not birthdays)
   * 
   * @param  Holiday $holiday
   * @return string
   */
  public function build(Holiday $holiday): string {
    $output = $holiday->getName();
    $output .= $holiday->getDescription();
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($holiday->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($holiday->isFlagDay()) {
      $output .= ViewFactory::flag('finland');
    }
    return $output;
  }

}
