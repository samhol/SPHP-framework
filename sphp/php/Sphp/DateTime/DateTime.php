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
use Exception;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a datetime object
 *
 * @method \Sphp\DateTime\DateTime setTimestamp(int $unixtimestamp) Creates a new instance based on a Unix timestamp
 * @method \Sphp\DateTime\DateTime setTimezone(\DateTimeZone $timezone) Creates a new instance with given time zone
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTime implements DateTimeInterface {

  /**
   * @var DateTimeImmutable 
   */
  private $dateTime;

  /**
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * Constructor
   * 
   * @param  mixed $time datetime data
   * @throws InvalidArgumentException if datetime cannot be parsed from input
   */
  public function __construct($time = null) {
    if ($time instanceof DateTimeImmutable) {
      $this->dateTime = $time;
    } else {
      try {
        $this->dateTime = DateTimes::dateTimeImmutable($time);
      } catch (Exception $ex) {
        throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
      }
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
    $this->reflector = null;
  }

  /**
   * Magic call method
   *
   * @param  string $name
   * @param  array $args
   * @return mixed
   * @throws BadMethodCallException
   */
  public function __call(string $name, array $args) {
    if ($this->reflector === null) {
      $this->reflector = new ReflectionClass($this->dateTime);
    }
    if (!$this->reflector->hasMethod($name)) {
      throw new BadMethodCallException("Method $name does not exist");
    } else {
      $reflectionMethod = $this->reflector->getMethod($name);
      $result = $reflectionMethod->invokeArgs($this->dateTime, $args);
      if ($result instanceof DateTimeImmutable) {
        return new static($result);
      } else {
        return $result;
      }
    }
    // $this->reflector->getMethod($name)->
    return $this->dateTime;
  }

  public function __toString(): string {
    return $this->format(\DateTime::ATOM);
  }

  /**
   * Returns the inner immutable datetime object
   * 
   * @return DateTimeImmutable the inner immutable datetime object
   */
  public function getDateTime(): DateTimeImmutable {
    return $this->dateTime;
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
      throw new InvalidArgumentException('Invalid format string');
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
   * Checks if this date is later than the given one
   * 
   * @param  mixed $date the date to match
   * @return bool true if this date is later than the given one and false otherwise
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->compareTo($date) > 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  mixed $date the date to match
   * @return bool true if this date is earlier than the given one and false otherwise
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->compareTo($date) < 0;
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $hours number of days to shift
   * @return DateTime new instance
   */
  public function jumpHours(int $hours): DateTime {
    return $this->modify("$hours hours");
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return DateTime new instance
   */
  public function jumpDays(int $days): DateTime {
    return $this->modify("$days day");
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return DateTime new instance
   */
  public function jumpMonths(int $months): DateTime {
    return $this->modify("$months months");
  }

  /**
   * Returns the next Date
   * 
   * @return DateTime new instance
   */
  public function nextDay(): DateTime {
    return $this->modify('+ 1 day');
  }

  /**
   * Returns the previous Date
   * 
   * @return DateTime new instance
   */
  public function previousDay(): DateTime {
    return $this->modify('- 1 day');
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
   * @return DateTime new instance
   * @throws InvalidArgumentException if formatting fails
   * @link   http://php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): DateTime {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
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
    //$interval = Factory::dateInterval($interval);
    $dt = $this->dateTime->add(Intervals::create($interval));
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
    $dt = $this->dateTime->sub(Intervals::create($interval));
    return new static($dt);
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
    return $this->dateTime->getOffset();
  }

  public function getTimeZoneName(): string {
    return $this->dateTime->getTimezone()->getName();
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $input raw datetime data
   * @return DateTime new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($input = null): DateTime {
    return new static($input);
  }

}
