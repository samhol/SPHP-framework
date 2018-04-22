<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Description of FinnishCalendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FinnishCalendar {

  /**
   * 
   * @param int $year
   * @return Calendar
   */
  public static function create(int $year): Calendar {
    $calendar = new Calendar();
    $calendar->addHoliday("$year-1-1", "New Year's Day");
    $calendar->addHoliday("$year-1-6", 'Epiphany');
    $calendar->merge(new EasterDays($year));
    $calendar->addHoliday("$year-5-1", 'May Day');
    $calendar->addHoliday("$year-12-6", 'Independence Day');
    $calendar->addHoliday("$year-12-24", 'Christmas Eve');
    $calendar->addHoliday("$year-12-25", 'Christmas Day');
    $calendar->addHoliday("$year-12-26", 'Boxing Day');
    $calendar->addHoliday("$year-12-31", "New Year's Eve");
    $j = Date::fromString("$year-6-20")->modify('next Saturday');
    $calendar->addHoliday($j, "Midsummer's Eve");
    $calendar->add(new MothersDay($year));
    $calendar->add(new FathersDay($year));
    return $calendar;
  }

}
