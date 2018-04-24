<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeInterface;
use DateTimeImmutable;

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
   * @param DateTimeInterface $dateTime
   */
  public function __construct(DateTimeInterface $dateTime = null) {
    if ($dateTime === null) {
      $dateTime = new DateTimeImmutable();
    } else if (!$dateTime instanceof DateTimeImmutable) {
      $dateTime = DateTimeImmutable::createFromMutable($dateTime);
    }
    $this->dateTime = $dateTime;
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
   * 
   * @return DateTimeImmutable
   */
  public function getDateTime(): DateTimeImmutable {
    return clone $this->dateTime;
  }

  /**
   * Returns the number of the weekday
   * 
   * @return int the number of the weekday
   */
  public function getWeekDay(): int {
    return (int) $this->dateTime->format('N');
  }

  /**
   * Returns the name of the weekday
   * 
   * @return string the name of the weekday
   */
  public function getWeekDayName(): string {
    return $this->dateTime->format('l');
  }

  /**
   * Returns the week number 
   * 
   * @return int the week number 
   */
  public function getWeek(): int {
    return (int) $this->dateTime->format('W');
  }

  /**
   * Returns the number of the month
   * 
   * @return int the number of the month
   */
  public function getMonth(): int {
    return (int) $this->dateTime->format('m');
  }

  /**
   * Returns the name of the month
   * 
   * @return string the name of the month
   */
  public function getMonthName(): string {
    return $this->dateTime->format('F');
  }

  /**
   * Returns the day of the month
   * 
   * @return int the day of the month
   */
  public function getMonthDay(): int {
    return (int) $this->dateTime->format('j');
  }

  /**
   * Returns the year
   * 
   * @return int the year
   */
  public function getYear(): int {
    return (int) $this->dateTime->format('Y');
  }

  /**
   * Checks whether the date is the current date
   * 
   * @return bool true if the date is the current date, false otherwise
   */
  public function isCurrent(): bool {
    $today = date('Y-m-d');
    $thisDay = $this->dateTime->format('Y-m-d');
    return $today === $thisDay;
  }

  /**
   * 
   * @param  mixed $date
   * @return bool
   */
  public function matchesWith($date): bool {
    if (is_string($date)) {
      $date = static::fromString($date);
    } else if (is_int($date)) {
      $date = static::fromTimestamp($date);
    }
    if ($date instanceof DateTimeInterface || $date instanceof Date) {
      return $date->format('Y-m-d') === $this->format('Y-m-d');
    }
    return false;
  }

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function format(string $format): string {
    $output = $this->dateTime->format($format);
    if ($output === false) {
      throw new \Sphp\Exceptions\RuntimeException();
    }
    return $this->dateTime->format($format);
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days 
   * @return Date new instance
   */
  public function jump(int $days): Date {
    $next = $this->dateTime->modify("$days day");
    return new Date($next);
  }

  /**
   * Returns the next Date
   * 
   * @return Date new instance
   */
  public function nextDate(): Date {
    $next = $this->dateTime->modify('+ 1 day');
    return new Date($next);
  }

  /**
   * Returns the previous Date
   * 
   * @return Date new instance
   */
  public function previousDate(): Date {
    $prev = $this->dateTime->modify('- 1 day');
    return new Date($prev);
  }

  /**
   * 
   * @return Date new instance
   */
  public function firstOfMonth(): Date {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the previous Date
   *  
   * @param  string $modify
   * @return Date new instance
   */
  public function modify(string $modify): Date {
    $prev = $this->dateTime->modify($modify);
    return new Date($prev);
  }

  /**
   * Creates a new instance
   * 
   * @param  int $day the day
   * @param  int $month the month
   * @param  int $year the year
   * @return Date new instance
   */
  public static function from(int $day = null, int $month = null, int $year = null): Date {
    if ($year === null) {
      $year = date('Y');
    }
    if ($month === null) {
      $month = date('D');
    }
    if ($day === null) {
      $day = date('j');
    }
    $date = new DateTimeImmutable("$year-$month-$day");
    return new static($date);
  }

  /**
   * Creates a new instance from a datetime string
   * 
   * @param  string $date datetime string
   * @return Date new instance
   */
  public static function fromString(string $date): Date {
    return new static(new DateTimeImmutable($date));
  }

  /**
   * Creates a new instance from unix timestamp
   * 
   * @param  int $unixtimestamp unix timestamp
   * @return Date new instance
   */
  public static function fromTimestamp(int $unixtimestamp): Date {
    $date = new DateTimeImmutable();
    $date->setTimestamp($unixtimestamp);
    return new static($date);
  }

}
