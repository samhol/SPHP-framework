<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;
use Sphp\Html\Tags;

/**
 * Implements a holiday view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
    $strong = Tags::strong($holiday->getName());
    $description = Tags::span(' '.$holiday->getDescription());
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($holiday->isNationalHoliday()) {
      $description->append(" (national holiday)");
    }
    if ($holiday->isFlagDay()) {
      $strong->prepend(ViewFactory::flag('finland'));
    }
    return $strong . $description;
  }

}
