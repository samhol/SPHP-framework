<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\Calendars\Diaries\MutableDiary;
use Sphp\DateTime\Date;

/**
 * Implements easter holiday collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterHolidays extends MutableDiary {

  /**
   * Constructor
   * 
   * @param int $year
   */
  public function __construct(int $year = null) {
    parent::__construct();
    if ($year === null) {
      $year = (int) date('Y');
    }
    $sunday = static::getEasterSunday($year);
    $this->insertLog(Holidays::unique($sunday->jumpDays(-3), 'Maundy Thursday'));
    $this->insertLog(Holidays::unique($sunday->jumpDays(-2), 'Good Friday')->setNationalHoliday());
    $this->insertLog(Holidays::unique($sunday, 'Easter Sunday')->setNationalHoliday());
    $this->insertLog(Holidays::unique($sunday->jumpDays(1), 'Easter Monday')->setNationalHoliday());
    $this->insertLog(Holidays::unique($sunday->jumpDays(39), 'Ascension Day')->setNationalHoliday());
    $this->insertLog(Holidays::unique($sunday->jumpDays(49), 'Pentecost')->setDescription('The seventh Sunday after Easter'));
  }

  /**
   * Returns the Maundy Thursday
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getMaundyThursday(int $year = null): Date {
    return static::getEasterSunday($year)->jumpDays(-3);
  }

  /**
   * Returns the Good Friday
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getGoodFriday(int $year = null): Date {
    return static::getEasterSunday($year)->jumpDays(-2);
  }

  /**
   * Returns the Easter Sunday
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterSunday(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $base = new \DateTimeImmutable("$year-03-21");
    $days = easter_days($year);
    $b = $base->add(new \DateInterval("P{$days}D"));
    return new Date($b);
  }

  /**
   * Returns the Easter Monday
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterMonday(int $year = null): Date {
    return static::getEasterSunday($year)->jumpDays(1);
  }

  /**
   * Returns the Ascension Day
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getAscensionDay(int $year = null): Date {
    return static::getEasterSunday($year)->jumpDays(39);
  }

  /**
   * Returns the Pentecost Day
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getPentecost(int $year = null): Date {
    return static::getEasterSunday($year)->jumpDays(49);
  }

}
