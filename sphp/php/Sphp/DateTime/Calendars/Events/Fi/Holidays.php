<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Fi;

use Sphp\DateTime\Calendars\Calendar as BaseCalendar;
use Sphp\DateTime\Calendars\EasterCalendar;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Events\EventDispatcher;
use Sphp\DateTime\Calendars\Events\Events;
use Sphp\DateTime\Calendars\Events\EasterHolidays;

//use Sphp\DateTime\Calendars\Calendar;

/**
 * Description of FinnishCalendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Holidays extends EventDispatcher {

  /**
   * @var EasterHolidays
   */
  private $easter;

  /**
   * Constructor
   * 
   * @param EasterHolidays $easter
   */
  public function __construct(EasterHolidays $easter = null) {
    if ($easter === null) {
      $easter = new EasterHolidays();
    }
    $this->easter = $easter;
    parent::__construct();
    $this->init();
  }

  protected function init() {
    $this->insertEvent(Events::annualHoliday(1, 1, "New Year's Day")->setNationalHoliday());
    $this->insertEvent(Events::annualHoliday(1, 6, 'Epiphany')->setNationalHoliday());
    $this->insertBirthday(2, 5, 'Johan Ludvig Runeberg', 1804)->setFlagDay(true);
    $this->insertAnnualHoliday(2, 28, 'Day of Kalevala')->setFlagDay(true);
    //$this->mergeCalendar();
    $this->insertAnnualHoliday(4, 27, "National War Veterans' Day")->setFlagDay(true);
    $this->insertAnnualHoliday(5, 1, 'May Day')->setFlagDay(true)->setNationalHoliday();
    $this->insertAnnualHoliday(5, 9, 'Europe Day')->setFlagDay(true);
    $this->insertVaryingAnnualHoliday("May %d second sunday", "Mothers's Day")->setFlagDay(true);
    $this->insertVaryingAnnualHoliday("May %d third sunday", 'memorial day')->setFlagDay(true);
    //$j = Date::fromString('%d-6-19 next Saturday');
    $this->insertBirthday(6, 4, 'Carl Gustaf Emil Mannerheim')->setFlagDay(true);
    $this->insertVaryingAnnualHoliday('%d-6-19 next Saturday', "Midsummer's Eve")->setNationalHoliday();
    $this->insertBirthday(7, 6, 'Eino Leino')->setFlagDay(true);
    $this->insertBirthday(10, 10, 'Aleksis Kivi')->setFlagDay(true);
    $this->insertAnnualHoliday(10, 10, 'Day of Finnish literature');
    $this->insertVaryingAnnualHoliday('%d-11-30 next Saturday', 'All Saints Day')->setNationalHoliday();
    $this->insertVaryingAnnualHoliday("November %d second sunday", "Father's Day")->setFlagDay(true);
    $this->insertAnnualHoliday(12, 6, 'Independence Day')->setFlagDay(true)->setNationalHoliday();
    $this->insertBirthday(12, 8, 'Jean Sibelius')->setFlagDay(true);
    $this->insertAnnualHoliday(12, 24, 'Christmas Eve');
    $this->insertAnnualHoliday(12, 25, 'Christmas Day')->setNationalHoliday();
    $this->insertAnnualHoliday(12, 26, 'Boxing Day')->setNationalHoliday();
    return $this;
  }

  public function setEasterFor(int $year = null) {
    $this->mergeEvents($this->easter->create($year));
    return $this;
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
