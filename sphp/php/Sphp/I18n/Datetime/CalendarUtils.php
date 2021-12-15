<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Datetime;

use Sphp\I18n\Exceptions\InvalidArgumentException;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarUtils {

  /**
   * January
   */
  const JAN = 1;

  /**
   * February
   */
  const FEB = 2;

  /**
   * March
   */
  const MAR = 3;

  /**
   * April
   */
  const APR = 4;

  /**
   * April
   */
  const MAY = 5;

  /**
   * June
   */
  const JUN = 6;

  /**
   * July
   */
  const JUL = 7;

  /**
   * August
   */
  const AUG = 8;

  /**
   * September
   */
  const SEP = 9;

  /**
   * October
   */
  const OCT = 10;

  /**
   * November
   */
  const NOV = 11;

  /**
   * December
   */
  const DEC = 12;

  /**
   * Monday
   */
  const MON = 1;

  /**
   * Tuesday
   */
  const TUE = 2;

  /**
   * Wednesday
   */
  const WED = 3;

  /**
   * Thursday
   */
  const THU = 4;

  /**
   * Friday
   */
  const FRI = 5;

  /**
   * saturday
   */
  const SAT = 6;

  /**
   * Sunday
   */
  const SUN = 7;

  /**
   * week day names in English
   *
   * @var string[]
   */
  private static $weekdays = [
      self::MON => 'Monday',
      self::TUE => "Tuesday",
      self::WED => 'Wednesday',
      self::THU => 'Thursday',
      self::FRI => 'Friday',
      self::SAT => 'Saturday',
      self::SUN => 'Sunday'];

  /**
   * @var int 
   */
  private int $fwd = self::MON;
  private ?string $locale;

  /**
   * Constructor
   */
  public function __construct(?string $locale = null) {
    $this->setLocale($locale);
  }

  /**
   * Returns the locale settings used
   * 
   * @return string|null the specific locale settings used (null if defaults)
   */
  public function getLocale(): ?string {
    return $this->locale;
  }

  /**
   * Sets the locale information
   * 
   * @param string|null $locale
   * @return $this for a fluent interface
   */
  public function setLocale(?string $locale) {
    $this->locale = $locale;
    return $this;
  }

  /**
   * Sets the daynmber
   * 
   * @param  int $wd optional number of the first weekday
   * @return $this for a fluent interface
   */
  public function setFirstDayOfWeek(int $wd = self::MON) {
    $this->fwd = $wd;
    return $this;
  }

  /**
   * Returns the name or the abbreviation of the given weekday number
   *
   * @param  int $wd weekday number (1-7)
   * @param  int|null $length optional length of the weekday string
   * @return string the name or the abbreviation of the given weekday number
   * @throws InvalidArgumentException if the weekday number number is incorrect 
   *                                  or the length is not positive or null
   */
  public function getWeekdayName(int $wd, ?int $length = null): string {
    if (!array_key_exists($wd, self::$weekdays)) {
      throw new InvalidArgumentException('Not a weekday number', 0);
    }
    if ($length !== null && $length < 1) {
      throw new InvalidArgumentException('Negative weekday name length given', 1);
    }
    $dayname = self::$weekdays[$wd];
    $day = \IntlDateFormatter::formatObject(new \DateTimeImmutable("last {$dayname}"), 'cccc', $this->getLocale());
    if ($length > 0) {
      $day = substr($day, 0, $length);
    }
    return $day;
  }

  /**
   * Returns the names or the abbreviations of the weekday names
   *
   * **Note:** array structure is <var>[weekday number] => "Weekday name"</var>.
   *
   * @param  int|null $length optional length of a individual weekday string
   * @return string[] the names or the abbreviations of the weekday names
   * @throws InvalidArgumentException if the length is not positive or null
   */
  public function getWeekdays(?int $length = null): array {
    $sequence = [];
    for ($d = 1; $d <= 7; $d++) {
      $sequence[$d] = $this->getWeekdayName($d, $length);
    }
    if ($this->fwd !== self::MON) {
      $first = array_slice($sequence, $this->fwd - 1);
      $last = array_slice($sequence, 0, (7 - count($first)));
      $sequence = array_merge($first, $last);
    }
    return $sequence;
  }

  /**
   * Returns the name or the abbreviation of the given month number
   *
   * @param  int $month month number (1-12)
   * @param  int|null $length optional length of the month string
   * @return string the name or the abbreviation of the given month number
   * @throws InvalidArgumentException if the month number is incorrect or the 
   *                                  length is not positive or null
   */
  public function getMonthName(int $month, ?int $length = null): string {
    if (($month < 1 || $month > 12)) {
      throw new InvalidArgumentException('Not a month number', 0);
    }
    if ($length !== null && $length < 1) {
      throw new InvalidArgumentException('Negative month name length given', 1);
    }
    $monthName = strftime('%B', mktime(0, 0, 0, $month, 10));
    if ($length > 0) {
      $monthName = mb_substr($monthName, 0, $length);
    }
    return $monthName;
  }

  /**
   * Returns the names or the abbreviations of the month names
   *
   * **Note:** array structure is <var>[month number] => "month name"</var>.
   *
   * @param  int|null $length optional length of a individual month name string
   * @return string[] the names or the abbreviations of the month names
   * @throws InvalidArgumentException if the length is negative or zero
   */
  public function getMonths(?int $length = null): array {
    $months = [];
    for ($month = 1; $month <= 12; $month++) {
      $months[$month] = $this->getMonthName($month, $length);
    }
    return $months;
  }

}
