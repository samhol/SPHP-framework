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
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use DateTimeZone;

/**
 * Implements a datetime object
 *
 * @method \Sphp\DateTime\ImmutableDateTime setTimestamp(int $unixtimestamp) Creates a new instance based on a Unix timestamp
 *  
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ImmutableDateTime implements DateTime {

  private DateTimeImmutable $dateTime;

  /**
   * Constructor
   * 
   * @param DateTimeImmutable|null $dateTime native datetime
   */
  public function __construct(?DateTimeImmutable $dateTime = null) {
    if ($dateTime === null) {
      $dateTime = new \DateTimeImmutable();
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
   * Clones the instance
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
    return $this->format('Y-m-d H:i:s.u T');
  }

  public function toDate(): ImmutableDate {
    return new ImmutableDate($this->getDateTime());
  }

  public function diff($date, bool $absolute = false): Interval {
    $other = DateTimes::dateTimeImmutable($date);
    $diff = $this->getDateTime()->diff($other, $absolute);
    return Interval::fromDateInterval($diff);
  }

  public function setISODate(int $year, int $week, int $dayOfWeek = 1): ImmutableDateTime {
    $dti = $this->getDateTime()->setISODate($year, $week, $dayOfWeek);
    return new static($dti);
  }

  public function getTimeZone(): DateTimeZone {
    return $this->getDateTime()->getTimezone();
  }

  public function getTimeZoneOffset(): int {
    return $this->getDateTime()->getOffset();
  }

  public function getTimeZoneName(): string {
    return $this->getDateTime()->getTimezone()->getName();
  }

  public function isCurrentTimezone(): bool {
    return self::now()->getTimeZoneOffset() === $this->getTimeZoneOffset();
  }

  public function getOffset(): int {
    return $this->getDateTime()->getOffset();
  }

  public function setTimezone(DateTimeZone $timezone): ImmutableDateTime {
    return static::from($this->getDateTime()->setTimezone($timezone));
  }

  public function useCurrentTimezone(): ImmutableDateTime {
    $ctz = new \DateTimeZone(date_default_timezone_get());
    return static::from($this->getDateTime()->setTimezone($ctz));
  }

  public function getTimestamp(): int {
    return $this->getDateTime()->getTimestamp();
  }

  public function getMicrotime(): float {
    return (float) $this->format('U.u');
  }

  public function compareTo(Date $date): int {
    if (!$date instanceof DateTime) {
      $out = $this->compareDateTo($date);
    } else {
      $out = $this->getMicrotime() <=> $date->getMicrotime();
    }
    return $out;
  }

  public function compareDateTo(Date $date): int {
    $result = $this->format('Ymd') <=> $date->format('Ymd');
    return $result;
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $hours number of days to shift
   * @return ImmutableDateTime new instance
   */
  public function jumpHours(int $hours): ImmutableDateTime {
    return $this->modify("$hours hours");
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return ImmutableDateTime new instance
   */
  public function jumpDays(int $days): ImmutableDateTime {
    return $this->modify("$days days");
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return DateTime new instance
   */
  public function jumpMonths(int $months): DateTime {
    $dti = DateTimes::addMonths($this->getDateTime(), $months);
    return new self($dti);
  }

  /**
   * Advances given number of years and returns a new instance
   * 
   * @param  int $years number of years to shift
   * @return DateTime new instance
   */
  public function jumpYears(int $years): DateTime {
    $dti = DateTimes::addMonths($this->getDateTime(), 12 * $years);
    return new self($dti);
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTime new instance
   */
  public function firstOfMonth(): DateTime {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTime new instance
   */
  public function lastOfMonth(): DateTime {
    return $this->modify('last day of this month');
  }

  /**
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return ImmutableDateTime new instance
   * @throws InvalidArgumentException if formatting fails
   * @link   https://www.php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): ImmutableDateTime {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $new = $this->getDateTime()->modify($modify);
    $thrower->stop();
    return new static($new);
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTime new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function add($interval): DateTime {
    $dt = $this->getDateTime()->add(Interval::create($interval));
    return new static($dt);
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTime new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function sub($interval): DateTime {
    $dt = $this->getDateTime()->sub(Interval::create($interval));
    return new static($dt);
  }

  public function getHours(): int {
    return (int) $this->getDateTime()->format('H');
  }

  public function getMinutes(): int {
    return (int) $this->getDateTime()->format('i');
  }

  public function getSeconds(): int {
    return (int) $this->getDateTime()->format('s');
  }

  public function getMicroseconds(): int {
    return (int) $this->getDateTime()->format('u');
  }

  public function setDate(int $year, int $month, int $day): DateTime {
    $dti = $this->getDateTime()->setDate($year, $month, $day);
    return new static($dti);
  }

  public function setTime(int $hour, int $minute, int $second = 0, int $microsecond = 0): DateTime {
    $dti = $this->getDateTime()->setTime($hour, $minute, $second, $microsecond);
    return new static($dti);
  }

  public function getTime(): Time {
    
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $input raw datetime data
   * @return ImmutableDateTime new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($input = null): ImmutableDateTime {
    try {
      if ($input instanceof ImmutableDateTime) {
        $out = $input;
      } else {
        $out = new static(DateTimes::dateTimeImmutable($input));
      }
      return $out;
    } catch (\Exception $ex) {
      throw new InvalidArgumentException(static::class . ' object cannot be parsed from input type', $ex->getCode(), $ex);
    }
  }

  /**
   * Creates a new instance from input
   * 
   * @return ImmutableDateTime new instance 
   */
  public static function now(): ImmutableDateTime {
    return new static(new DateTimeImmutable());
  }

  /**
   * 
   * @param  string $format
   * @param  string $time
   * @param  \DateTimeZone $timezone
   * @return ImmutableDateTime|null
   */
  public static function createFromFormat(string $format, string $time, \DateTimeZone $timezone = null): ?ImmutableDateTime {
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

}
