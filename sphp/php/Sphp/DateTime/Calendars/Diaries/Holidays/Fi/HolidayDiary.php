<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays\Fi;

use Sphp\DateTime\Calendars\Diaries\LogDispatcher;
use Sphp\DateTime\Calendars\Diaries\Holidays\EasterHolidays;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

/**
 * Implements a diary containing some common Finnish holidays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HolidayDiary extends LogDispatcher {

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
    $country = 'finland';
    $this->insertLog(Holidays::annual(1, 1, "New Year's Day")->setNationalHoliday());
    $this->insertLog(Holidays::annual(1, 6, 'Epiphany')->setNationalHoliday());
    $this->insertLog(Holidays::birthday(1804, 2, 5, 'Johan Ludvig Runeberg')->setFlagDay($country));
    $this->insertLog(Holidays::annual(2, 28, 'Day of Kalevala')->setFlagDay($country));
    $this->insertLog(Holidays::annual(4, 27, "National War Veterans' Day")->setFlagDay($country));
    $this->insertLog(Holidays::annual(5, 1, 'May Day')->setFlagDay($country)->setNationalHoliday());
    $this->insertLog(Holidays::annual(5, 9, 'Europe Day')->setFlagDay(true));
    $this->insertLog(Holidays::varyingAnnual('May %d second sunday', "Mothers's Day")->setFlagDay($country));
    $this->insertLog(Holidays::varyingAnnual('May %d third sunday', 'memorial day')->setFlagDay($country));
    $this->insertLog(Holidays::birthday(1867, 6, 4, 'Carl Gustaf Emil Mannerheim')->setFlagDay($country));
    $this->insertLog(Holidays::varyingAnnual('%d-6-19 next Saturday', "Midsummer's Eve")->setNationalHoliday());
    $this->insertLog(Holidays::birthday(1878, 7, 6, 'Eino Leino')->setFlagDay($country));
    $this->insertLog(Holidays::birthday(1834, 10, 10, 'Aleksis Kivi')->setFlagDay($country));
    $this->insertLog(Holidays::annual(10, 10, 'Day of Finnish literature'));
    $this->insertLog(Holidays::varyingAnnual('%d-11-30 next Saturday', 'All Saints Day')->setNationalHoliday());
    $this->insertLog(Holidays::varyingAnnual('November %d second sunday', "Father's Day")->setFlagDay($country));
    $this->insertLog(Holidays::annual(12, 6, 'Independence Day')->setFlagDay($country)->setNationalHoliday());
    $this->insertLog(Holidays::birthday(1865, 12, 8, 'Jean Sibelius')->setFlagDay($country));
    $this->insertLog(Holidays::annual(12, 24, 'Christmas Eve'));
    $this->insertLog(Holidays::annual(12, 25, 'Christmas Day')->setNationalHoliday());
    $this->insertLog(Holidays::annual(12, 26, 'Boxing Day')->setNationalHoliday());
    return $this;
  }

  public function setEasterFor(int $year = null) {
    $easter = new EasterHolidays($year);
    $this->merge($easter);
    return $this;
  }

}
