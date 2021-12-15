<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeImmutable;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

/**
 * Implements a date object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ImmutableDate implements Date {

  /**
   * @var DateTimeImmutable 
   */
  private DateTimeImmutable $dateTime;

  /**
   * Constructor
   * 
   * @param  DateTimeImmutable|null $date inner datetime object 
   */
  public function __construct(?DateTimeImmutable $date = null) {
    if ($date === null) {
      $date = new DateTimeImmutable();
    }
    $tz = new \DateTimeZone(date_default_timezone_get());
    $this->dateTime = $date->setTimezone($tz)->setTime(0, 0, 0, 0);
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

  /**
   * Returns the inner immutable datetime object
   * 
   * @return DateTimeImmutable the inner immutable datetime object
   */
  public function getDateTime(): DateTimeImmutable {
    return $this->dateTime;
  }

  public function format(string $format): string {
    $output = $this->getDateTime()->format($format);
    return (string) $output;
  }

  public function getWeekDay(): int {
    return (int) $this->getDateTime()->format('N');
  }

  public function getWeekDayName(): string {
    return $this->getDateTime()->format('l');
  }

  public function getWeek(): int {
    return (int) $this->getDateTime()->format('W');
  }

  public function getMonth(): int {
    return (int) $this->getDateTime()->format('m');
  }

  public function getMonthName(): string {
    return $this->getDateTime()->format('F');
  }

  public function getMonthDay(): int {
    return (int) $this->getDateTime()->format('j');
  }

  public function getYear(): int {
    return (int) $this->getDateTime()->format('Y');
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
   * Checks whether the week is the current week
   * 
   * @return bool true if the week number is current, false otherwise
   */
  public function isCurrentWeek(): bool {
    $today = date('Y-m-W');
    $thisDay = $this->getDateTime()->format('Y-m-W');
    return $today === $thisDay;
  }

  /**
   * Checks whether the month is the current week
   * 
   * @return bool true if the month is current, false otherwise
   */
  public function isCurrentMonth(): bool {
    $currentMonth = date('Y-m');
    $thisMonth = $this->getDateTime()->format('Y-m');
    return $currentMonth === $thisMonth;
  }

  public function dateEqualsTo(Date $date): bool {
    return $date->format('Ymd') === $this->format('Ymd');
  }

  public function __toString(): string {
    return $this->format('Y-m-d');
  }

  public function diff($date, bool $absolute = false): Interval {
    try {
      $other = ImmutableDate::from($date);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('The date to compare to is invalid', $ex->getCode(), $ex);
    }
    //print_r($other);
    $mut = $other->getDateTime();
    $mut = $mut->setTimezone($this->getDateTime()->getTimezone());
    //echo "\nthis:". $this->getDateTime()->getTimezone()->getName();
    //echo "\nmut:". $mut->getTimezone()->getName();
    $diff = $this->getDateTime()->diff($mut, $absolute);
    return Intervals::fromDateInterval($diff);
  }

  public function compareDateTo(Date $date): int {
    $result = $this->format('Ymd') <=> $date->format('Ymd');
    return $result;
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return Date new instance
   */
  public function jumpDays(int $days): Date {
    return new ImmutableDate($this->getDateTime()->modify("$days day"));
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return Date new instance
   */
  public function jumpMonths(int $months): Date {
    $dti = DateTimes::addMonths($this->getDateTime(), $months);
    return new self($dti);
  }

  /**
   * Advances given number of years and returns a new instance
   * 
   * @param  int $years number of years to shift
   * @return Date new instance
   */
  public function jumpYears(int $years): Date {
    $dti = DateTimes::addMonths($this->getDateTime(), 12 * $years);
    return new self($dti);
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return Date new instance
   */
  public function firstOfMonth(): Date {
    return new ImmutableDate($this->getDateTime()->modify('first day of this month'));
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return Date new instance
   */
  public function lastOfMonth(): Date {
    return new ImmutableDate($this->getDateTime()->modify('last day of this month'));
  }

  public function setDate(int $year, int $month, int $day): ImmutableDate {
    $dti = $this->getDateTime()->setDate($year, $month, $day);
    return new self($dti);
  }

  /**
   * Creates a new instance
   * 
   * @param  mixed $date raw date data
   * @return ImmutableDate new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($date): ImmutableDate {
    try {
      if ($date instanceof ImmutableDate) {
        $out = $date;
      } else {
        $out = new static(DateTimes::dateTimeImmutable($date));
      }
      return $out;
    } catch (\Exception $ex) {
      throw new InvalidArgumentException(static::class . ' object cannot be parsed from input type', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new instance of today
   * 
   * @return ImmutableDate new instance of today
   */
  public static function now(): ImmutableDate {
    return new static(new DateTimeImmutable());
  }

  /**
   * 
   * @param  string $format
   * @param  string $time
   * @param  \DateTimeZone $timezone
   * @return ImmutableDate|null
   */
  public static function createFromFormat(string $format, string $time, \DateTimeZone $timezone = null): ?ImmutableDate {
    $dti = DateTimeImmutable::createFromFormat($format, $time, $timezone);
    if ($dti === false) {
      // var_dump(DateTimeImmutable::getLastErrors());
      //var_dump(date_get_last_errors());
      $err = date_get_last_errors();
      $msg = 'Cannot create date from format';
      if (is_array($err) && is_array(['errors'])) {
        $msg .= " (" . count($err['errors']) . ' errors)';
      }
      //echo $msg;
      throw new InvalidArgumentException($msg);
    }
    return new static($dti);
  }

  /**
   * 
   * 
   * @param  int $day
   * @param  int $month
   * @param  int $year
   * @return ImmutableDate
   */
  public static function mkDate(int $day, int $month, int $year): ImmutableDate {
    $dti = (new DateTimeImmutable())->setDate($year, $month, $day);
    return new static($dti);
  }

}
