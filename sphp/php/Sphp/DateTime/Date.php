<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeImmutable;
use Sphp\Exceptions\InvalidArgumentException;
use Exception;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements a date object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Date implements DateInterface {

  /**
   * @var DateTimeImmutable 
   */
  private $dateTime;

  /**
   * Constructor
   * 
   * @param  mixed $date raw date data
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function __construct($date = null) {
    try {
      $this->dateTime = new DateTimeImmutable(DateTimes::parseDateString($date));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException(static::class . ' object cannot be parsed from input type', $ex->getCode(), $ex);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateTime);
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->dateTime = clone $this->dateTime;
  }

  public function __toString(): string {
    return $this->format('Y-m-d');
  }

  /**
   * Returns the inner immutable datetime object
   * 
   * @return DateTimeImmutable the inner immutable datetime object
   */
  public function getDateTime(): DateTimeImmutable {
    return clone $this->dateTime;
  }

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int {
    return $this->getDateTime()->getTimestamp();
  }

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws InvalidArgumentException if formatting fails
   */
  public function format(string $format): string {
    $output = $this->getDateTime()->format($format);
    if ($output === false) {
      throw new InvalidArgumentException();
    }
    return $output;
  }

  /**
   * Returns the number of the weekday
   * 
   * @return int the number of the weekday
   */
  public function getWeekDay(): int {
    return (int) $this->format('N');
  }

  /**
   * Returns the name of the weekday
   * 
   * @return string the name of the weekday
   */
  public function getWeekDayName(): string {
    return $this->format('l');
  }

  /**
   * Returns the week number 
   * 
   * @return int the week number 
   */
  public function getWeek(): int {
    return (int) $this->format('W');
  }

  /**
   * Returns the number of the month
   * 
   * @return int the number of the month
   */
  public function getMonth(): int {
    return (int) $this->format('m');
  }

  /**
   * Returns the name of the month
   * 
   * @return string the name of the month
   */
  public function getMonthName(): string {
    return $this->format('F');
  }

  /**
   * Returns the day of the month
   * 
   * @return int the day of the month
   */
  public function getMonthDay(): int {
    return (int) $this->format('j');
  }

  /**
   * Returns the year
   * 
   * @return int the year
   */
  public function getYear(): int {
    return (int) $this->format('Y');
  }

  /**
   * Checks whether the date is the current date
   * 
   * @return bool true if the date is the current date, false otherwise
   */
  public function isCurrentDate(): bool {
    $today = date('Y-m-d');
    $thisDay = $this->getDateTime()->format('Y-m-d');
    return $today === $thisDay;
  }

  /**
   * Returns the difference in days between this and another date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return int the difference in days
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = Date::from($date)->getTimestamp();
    $timeStamp = $this->getTimestamp();
    $result = $timeStamp <=> $dt;
    return $result;
  }

  public function dateEqualsTo($date): bool {
    try {
      $parsed = DateTimes::parseDateString($date);
      return $parsed === $this->format('Y-m-d');
    } catch (Exception $ex) {
      return false;
    }
  }

  /**
   * Checks if this date is later than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->diff($date) < 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->diff($date) > 0;
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return Date new instance
   */
  public function jumpDays(int $days): Date {
    return $this->modify("$days day");
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return Date new instance
   */
  public function jumpMonths(int $months): Date {
    return $this->modify("$months months");
  }

  /**
   * Returns the next Date
   * 
   * @return Date new instance
   */
  public function nextDay(): Date {
    return $this->modify('+ 1 day');
  }

  /**
   * Returns the previous Date
   * 
   * @return Date new instance
   */
  public function previousDay(): Date {
    return $this->modify('- 1 day');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return Date new instance
   */
  public function firstOfMonth(): Date {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTimeInterface new instance
   */
  public function lastOfMonth(): Date {
    return $this->modify('last day of this month');
  }

  /**
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return Date new instance
   * @throws InvalidArgumentException if formatting fails
   * @link   http://php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): Date {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
    $thrower->stop();
    return new Date($new);
  }

  /**
   * Creates a new instance
   * 
   * @param  mixed $date raw date data
   * @return Date new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($date): Date {
    return new static($date);
  }

}
