<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Fi;

use Sphp\DateTime\Calendars\Calendar as BaseCalendar;
use Sphp\DateTime\Calendars\EasterCalendar;
use Sphp\DateTime\Date;

//use Sphp\DateTime\Calendars\Calendar;

/**
 * Description of FinnishCalendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Calendar extends BaseCalendar {

  public function __construct() {
    parent::__construct();
  }

  /**
   * 
   * @param int $year
   * @return Calendar
   */
  public  function createYear(int $year) {
    $this->setHoliday("$year-1-1", "New Year's Day")->setNationalHoliday();
    $this->setHoliday("$year-1-6", 'Epiphany')->setNationalHoliday();
    $this->setBirthDay("$year-2-5", 'Johan Ludvig Runeberg')->setFlagDay(true);
    $this->setHoliday("$year-2-28", "Day of Kalevala")->setFlagDay(true);
    $this->mergeCalendar(static::getEasterCalendar($year));
    $this->setHoliday("$year-4-27", "National War Veterans' Day")->setFlagDay(true);
    $this->setHoliday("$year-5-1", 'May Day')->setFlagDay(true)->setNationalHoliday();
    $this->setHoliday("$year-5-9", 'Europe Day')->setFlagDay(true);
    $this->setHoliday("May $year second sunday", "Mothers's Day")->setFlagDay(true);
    $this->setHoliday("May $year third sunday", 'memorial day')->setFlagDay(true);
    $j = Date::fromString("$year-6-20")->modify('next Saturday');
    $this->setBirthDay("$year-6-4", 'Carl Gustaf Emil Mannerheim')->setFlagDay(true);
    $this->setHoliday($j, "Midsummer's Eve")->setNationalHoliday();
    $this->setBirthDay("$year-7-6", 'Eino Leino')->setFlagDay(true);
    $this->setBirthDay("$year-10-10", 'Aleksis Kivi')->setFlagDay(true);
    $this->setHoliday("$year-10-10", 'Day of Finnish literature');
    $this->setHoliday(static::getAllSaintsDay($year), 'All Saints Day')->setNationalHoliday();
    $this->setHoliday("November $year second sunday", "Father's Day")->setFlagDay(true);
    $this->setHoliday("$year-12-6", 'Independence Day')->setFlagDay(true)->setNationalHoliday();
    $this->setBirthDay("$year-12-8", 'Jean Sibelius')->setFlagDay(true);
    $this->setHoliday("$year-12-24", 'Christmas Eve');
    $this->setHoliday("$year-12-25", 'Christmas Day')->setNationalHoliday();
    $this->setHoliday("$year-12-26", 'Boxing Day')->setNationalHoliday();
    return $this;
  }

  public function january(int $year = null): Calendar {
    $calendar = new Calendar();
    $calendar->setHoliday("$year-1-1", "New Year's Day")->setNationalHoliday();
    $calendar->setHoliday("$year-1-6", 'Epiphany')->setNationalHoliday();
    return $calendar;
  }

  public function february(int $year = null): Calendar {
    $calendar = new Calendar();
    $calendar->setBirthDay("$year-2-5", 'Johan Ludvig Runeberg')->setFlagDay(true);
    $calendar->setHoliday("$year-2-28", 'Day of Kalevala')->setFlagDay(true);
    return $calendar;
  }

  public function december(int $year = null): Calendar {
    $calendar = new Calendar();
    $calendar->setHoliday("$year-12-6", 'Independence Day')->setFlagDay(true)->setNationalHoliday();
    $calendar->setBirthDay("$year-12-8", 'Jean Sibelius')->setFlagDay(true);
    $calendar->setHoliday("$year-12-24", 'Christmas Eve');
    $calendar->setHoliday("$year-12-25", 'Christmas Day')->setNationalHoliday();
    $calendar->setHoliday("$year-12-26", 'Boxing Day')->setNationalHoliday();
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

  public static function getEasterCalendar(int $year = null): BaseCalendar {
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
