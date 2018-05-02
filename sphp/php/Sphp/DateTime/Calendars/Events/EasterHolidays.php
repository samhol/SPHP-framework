<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\Date;

/**
 * Description of EasterHoliday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterHolidays extends EventCollection {

  /**
   * Constructor
   * 
   * @param  int $year
   * @return EventCollection
   */
  public function __construct(int $year = null) {
    parent::__construct();
    if ($year === null) {
      $year = (int) date('Y');
    }
    $sunday = static::getEasterSunday($year);
    $this->insertEvent(Holidays::unique($sunday->jump(-3), 'Maundy Thursday'));
    $this->insertEvent(Holidays::unique($sunday->jump(-2), 'Good Friday')->setNationalHoliday());
    $this->insertEvent(Holidays::unique($sunday, 'Easter Sunday')->setNationalHoliday());
    $this->insertEvent(Holidays::unique($sunday->jump(1), 'Easter Monday')->setNationalHoliday());
    $this->insertEvent(Holidays::unique($sunday->jump(39), 'Ascension Day')->setNationalHoliday());
    $this->insertEvent(Holidays::unique($sunday->jump(49), 'Pentecost'));
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getMaundyThursday(int $year = null): Date {
    return static::getEasterSunday($year)->jump(-3);
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
    $base = new \DateTimeImmutable("$year-03-21");
    $days = easter_days($year);
    $b = $base->add(new \DateInterval("P{$days}D"));
    return new Date($b);
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
    return static::getEasterSunday($year)->jump(39);
  }

  /**
   * 
   * @param  int $year optional year (uses current if omitted) 
   * @return Date new date object
   */
  public static function getPentecost(int $year = null): Date {
    return static::getEasterSunday($year)->jump(49);
  }

}
