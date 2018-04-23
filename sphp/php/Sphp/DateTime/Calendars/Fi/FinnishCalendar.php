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
class FinnishCalendar extends Calendar {

  public function __construct() {
    parent::__construct();
  }
  /**
   * 
   * @param int $year
   * @return Calendar
   */
  public static function create(int $year): Calendar {
    $calendar = new Calendar();
    $calendar->addHoliday("$year-1-1", "New Year's Day")->setNationalHoliday();
    $calendar->addHoliday("$year-1-6", 'Epiphany')->setNationalHoliday();
    $calendar->addBirthDay("$year-2-5", 'Johan Ludvig Runeberg')->setFlagDay(true);
    $calendar->addHoliday("$year-2-28", "Day of Kalevala")->setFlagDay(true);
    $calendar->merge(static::getEasterCalendar($year));
    $calendar->addHoliday("$year-4-27", "National War Veterans' Day")->setFlagDay(true);
    $calendar->addHoliday("$year-5-1", 'May Day')->setFlagDay(true)->setNationalHoliday();;
    $calendar->addHoliday("$year-5-9", 'Europe Day')->setFlagDay(true);
    $calendar->addHoliday("May $year second sunday", "Mothers's Day")->setFlagDay(true);
    $calendar->addHoliday("May $year third sunday", 'memorial day')->setFlagDay(true);
    $j = Date::fromString("$year-6-20")->modify('next Saturday');
    $calendar->addBirthDay("$year-6-4", 'Carl Gustaf Emil Mannerheim')->setFlagDay(true);
    $calendar->addHoliday($j, "Midsummer's Eve")->setNationalHoliday();
    $calendar->addBirthDay("$year-7-6", 'Eino Leino')->setFlagDay(true);
    $calendar->addBirthDay("$year-10-10", 'Aleksis Kivi')->setFlagDay(true);
    $calendar->addHoliday("$year-10-10", 'Day of Finnish literature');
    $calendar->addHoliday(static::getAllSaintsDay($year), 'All Saints Day')->setNationalHoliday();
    $calendar->addHoliday("November $year second sunday", "Father's Day")->setFlagDay(true);
    $calendar->addHoliday("$year-12-6", 'Independence Day')->setFlagDay(true)->setNationalHoliday();
    $calendar->addBirthDay("$year-12-8", 'Jean Sibelius')->setFlagDay(true);
    $calendar->addHoliday("$year-12-24", 'Christmas Eve');
    $calendar->addHoliday("$year-12-25", 'Christmas Day')->setNationalHoliday();
    $calendar->addHoliday("$year-12-26", 'Boxing Day')->setNationalHoliday();
    return $calendar;
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

  public static function getEasterCalendar(int $year = null): Calendar {
    $easterCalendar = EasterCalendar::build($year);
    foreach ($easterCalendar as $day) {
      if ($day instanceof \Sphp\DateTime\Calendars\Holiday) {
        $day->setNationalHoliday(true);
      }
    }
    return EasterCalendar::build($year);
  }

  public static function getSundays($y, $m = 1) {
    $date = "$y-$m-01";
    $first_day = date('N', strtotime($date));
    $first_day = 7 - $first_day + 1;
    $last_day = date('t', strtotime($date));
    $days = array();
    for ($i = $first_day; $i <= $last_day; $i = $i + 7) {
      $days[] = $i;
    }
    return $days;
  }

}
