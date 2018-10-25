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

/**
 * Implements a datetime object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTime extends DateTimeImmutable implements DateTimeInterface {

  public function __toString(): string {
    return $this->format('Y-m-d h:i:s O');
  }

  /**
   * Returns the difference in days between this and another date
   * 
   * @param  mixed $date raw date data
   * @return int the difference in days
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = static::from($date)->getTimestamp();
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
   * Advances given number of days and returns a new instance
   * 
   * @param  int $hours number of days to shift
   * @return DateTimeInterface new instance
   */
  public function jumpHours(int $hours): DateTimeInterface {
    return $this->modify("$hours hours");
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return DateTimeInterface new instance
   */
  public function jumpDays(int $days): DateTimeInterface {
    return $this->modify("$days day");
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return DateTimeInterface new instance
   */
  public function jumpMonths(int $months): DateTimeInterface {
    return $this->modify("$months months");
  }

  /**
   * Returns the next Date
   * 
   * @return DateTimeInterface new instance
   */
  public function nextDay(): DateTimeInterface {
    return $this->modify('+ 1 day');
  }

  /**
   * Returns the previous Date
   * 
   * @return DateTimeInterface new instance
   */
  public function previousDay(): DateTimeInterface {
    return $this->modify('- 1 day');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTimeInterface new instance
   */
  public function firstOfMonth(): DateTimeInterface {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTimeInterface new instance
   */
  public function lastOfMonth(): DateTimeInterface {
    return $this->modify('last day of this month');
  }

  public function getHours(): int {
    return (int) $this->format('H');
  }

  public function getMinutes(): int {
    return (int) $this->format('i');
  }

  public function getSeconds(): int {
    return (int) $this->format('s');
  }

  public function getTimeZoneOffset(): int {
    return parent::getOffset();
  }

  public function getTimeZoneName(): string {
    return parent::getTimezone()->getName();
  }

  /**
   * Creates a new instance from input
   * 
   * @param  DateInterface|mixed $input raw datetime data
   * @return DateTime new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($input = null): DateTime {
    try {
      if ($input === null) {
        $dateTime = new static('now');
      } else if ($input instanceof DateTime) {
        $dateTime = clone $input;
      } else if (is_string($input)) {
        $dateTime = new static($input);
      } else if (is_int($input)) {
        $dateTime = new static("@$input");
      } else if ($input instanceof DTI) {
        $dateTime = DateTime::createFromMutable($input);
      } else if ($input instanceof DateInterface) {
        $timestamp = $input->getTimestamp();
        $dateTime = new static("@$timestamp");
      }
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
    }
    if (!$dateTime instanceof DateTime) {
      throw new InvalidArgumentException('Datetime object cannot be parsed from input type');
    }
    return $dateTime;
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
    $today = DateWrapper('Y-m-d');
    $thisDay = $this->format('Y-m-d');
    return $today === $thisDay;
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  int|string|Interval|DateInterval $interval the interval to add
   * @return DateTimeInterface new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function add($interval) {
    return parent::add(Intervals::create($interval));
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  int|string|Interval|DateInterval $interval the interval to add
   * @return DateTimeInterface new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function sub($interval) {
    return parent::sub(Intervals::create($interval));
  }

}
