<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Notes;

use Sphp\DateTime\Date;

/**
 * Description of EasterHoliday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EasterHolidays extends NoteCollection {

  private $years = [];

  public function getNotesForDate($date): array {
    $parsed = Date::from($date);
    $this->buildYear($parsed->getYear());
    return parent::getNotesForDate($date);
  }

  public function buildYear(int $year = null) {
    if ($year === null) {
      $year = (int) date('Y');
    }
    if (!in_array($year, $this->years, true)) {
      $this->years[] = $year;
      $this->insertHoliday(static::getMaundyThursday($year), 'Maundy Thursday');
      $this->insertHoliday(static::getGoodFriday($year), 'Good Friday')->setNationalHoliday();
      $this->insertHoliday(static::getEasterSunday($year), 'Easter Sunday')->setNationalHoliday();
      $this->insertHoliday(static::getEasterMonday($year), 'Easter Monday')->setNationalHoliday();
      $this->insertHoliday(static::getAscensionDay($year), 'Ascension Day')->setNationalHoliday();
      $this->insertHoliday(static::getPentecost($year), 'Pentecost');
    }
    return $this;
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
