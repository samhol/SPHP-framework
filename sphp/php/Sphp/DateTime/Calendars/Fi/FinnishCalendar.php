<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Fi;

use Sphp\DateTime\Calendars\Calendar;
use Sphp\DateTime\Calendars\EasterCalendar;
use Sphp\DateTime\Date;

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
    $calendar->merge(EasterCalendar::build($year));
    $calendar->addHoliday("$year-5-1", 'May Day');
    $calendar->addHoliday(static::getMothersDay($year), "Mothers's Day");
    $calendar->addHoliday($j, "Midsummer's Eve");
    $calendar->addHoliday(static::getAllSaintsDay($year), 'All Saints Day');
    $calendar->addHoliday(static::getFathersDay($year), "Father's Day");
    $calendar->addHoliday("$year-12-6", 'Independence Day');
    $calendar->addHoliday("$year-12-24", 'Christmas Eve');
    $calendar->addHoliday("$year-12-25", 'Christmas Day');
    $calendar->addHoliday("$year-12-26", 'Boxing Day');
    $calendar->addHoliday("$year-12-31", "New Year's Eve");
    $j = Date::fromString("$year-6-20")->modify('next Saturday');
    return $calendar;
  }

  public static function getMothersDay(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $f = Date::fromString("$year-5-1");
    if ($f->getWeekDay() === 7) {
      $f = $f->jump(7);
    } else {
      $f = $f->modify('next Sunday')->jump(7);
    }
    return $f;
  }

  public static function getFathersDay(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $f = Date::fromString("$year-11-1");
    if ($f->getWeekDay() === 7) {
      $f = $f->jump(7);
    } else {
      $f = $f->modify('next Sunday')->jump(7);
    }
    return $f;
  }

  public static function getAllSaintsDay(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $f = Date::fromString("$year-10-31");
    if (!$f->getWeekDay() === 6) {
      $f = $f->modify('next Saturday')->jump(7);
    }
    return $f;
  }

  /**
   * 
   * @param int $year
   * @return Calendar
   */
  public static function flagDays(int $year): Calendar {
    $calendar = new Calendar();
    $calendar->addHoliday("$year-2-5", 'birthday of the national poet Johan Ludvig Runeberg');
    $calendar->addHoliday("$year-2-28", "Day of Kalevala");
    $calendar->addHoliday("$year-5-1", 'May Day');
    $calendar->addHoliday(static::getMothersDay($year), "Mothers's Day");
    $calendar->addHoliday($j, "Midsummer's Eve");
    $calendar->addHoliday(static::getAllSaintsDay($year), 'All Saints Day');
    $calendar->addHoliday(static::getFathersDay($year), "Father's Day");
    $calendar->addHoliday("$year-12-6", 'Independence Day');
    $calendar->addHoliday("$year-12-8", ' birthday of the composer Jean Sibelius');
    $calendar->addHoliday("$year-12-24", 'Christmas Eve');
    $calendar->addHoliday("$year-12-25", 'Christmas Day');
    $calendar->addHoliday("$year-12-26", 'Boxing Day');
    $calendar->addHoliday("$year-12-31", "New Year's Eve");
    $j = Date::fromString("$year-6-20")->modify('next Saturday');
    return $calendar;
  }

}
