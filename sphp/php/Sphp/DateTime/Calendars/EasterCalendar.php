<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use DateTime;
use Sphp\DateTime\Date;

/**
 * Description of EasterDays
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterCalendar {

  public static function build(int $year = null): Calendar {
    if ($year === null) {
      $year = (int) date('Y');
    }
    $calendar = new Calendar();
    $calendar->addHoliday(static::getMaundyThursday($year), 'Maundy Thursday');
    $calendar->addHoliday(static::getGoodFriday($year), 'Good Friday');
    $calendar->addHoliday(static::getEasterSunday($year), 'Easter Sunday');
    $calendar->addHoliday(static::getEasterMonday($year), 'Easter Monday');
    $calendar->addHoliday(static::getAscensionDay($year), 'Ascension Day');
    return $calendar;
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getMaundyThursday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(-4);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getGoodFriday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(-2);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterSunday(int $year = null): Date {
    if ($year === null) {
      $year = (int) date('Y');
    }
    return Date::fromTimestamp(easter_date());
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getEasterMonday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(1);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getAscensionDay(int $year = null): Date {
    return static::getEasterSunday($year)->jump(41);
  }

}
