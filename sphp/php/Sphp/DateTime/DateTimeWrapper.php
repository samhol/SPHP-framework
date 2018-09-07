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
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTimeWrapper implements DateTimeInterface {

  use DateTrait;

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
   * @param  mixed $time raw date data
   * @throws InvalidArgumentException if datetime cannot be parsed from input
   */
  public function __construct($time = null) {
    try {
      $this->dateTime = DateTimes::dateTimeImmutable($time);
    } catch (Exception $ex) {
      throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
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
      var_dump($reflectionMethod->invokeArgs($this->dateTime, $args));
      return $this->dateTime;
    }
    // $this->reflector->getMethod($name)->
    return $this->dateTime;
  }

  public function __toString(): string {
    return $this->format('Y-m-d h:i:s O');
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
   * Returns the difference in days between this and another date
   * 
   * @param  mixed $date raw date data
   * @return int the difference in days
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = static::from($date)->getTimestamp();
    $timeStamp = $this->getTimestamp();
    $result = $timeStamp - $dt;
    return $result;
  }

  public function equals($date): bool {
    try {
      return $this->compareTo($date) === 0;
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
    return $this->compareTo($date) < 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  mixed $date the date to match
   * @return bool true if this date is earlier than the given one and false otherwise
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->compareTo($date) > 0;
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $hours number of days to shift
   * @return DateTimeWrapper new instance
   */
  public function jumpHours(int $hours): DateTimeWrapper {
    return $this->modify("$hours hours");
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return DateTimeWrapper new instance
   */
  public function jumpDays(int $days): DateTimeWrapper {
    return $this->modify("+ $days day");
  }

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return DateTimeWrapper new instance
   */
  public function jumpMonths(int $months): DateTimeWrapper {
    return $this->modify("$months months");
  }

  /**
   * Returns the next Date
   * 
   * @return DateTimeWrapper new instance
   */
  public function nextDay(): DateTimeWrapper {
    return $this->modify('+ 1 day');
  }

  /**
   * Returns the previous Date
   * 
   * @return DateTimeWrapper new instance
   */
  public function previousDay(): DateTimeWrapper {
    return $this->modify('- 1 day');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTimeWrapper new instance
   */
  public function firstOfMonth(): DateTimeWrapper {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the date representing the first of the same month
   * 
   * @return DateTimeWrapper new instance
   */
  public function lastOfMonth(): DateTimeWrapper {
    return $this->modify('last day of this month');
  }

  /**
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return DateTimeWrapper new instance
   * @throws InvalidArgumentException if formatting fails
   * @link   http://php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): DateTimeWrapper {
    $thrower = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
    $thrower->stop();
    return static::from($new);
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTimeWrapper new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function add($interval): DateTimeWrapper {
    //$interval = Factory::dateInterval($interval);
    $dt = $this->dateTime->add(Intervals::create($interval));
    $result = new static($dt);
    return $result;
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTimeWrapper new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function sub($interval): DateTimeWrapper {
    $dt = $this->dateTime->sub(Intervals::create($interval));
    $result = new static($dt);
    return $result;
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

  /**
   * Creates a new instance from input
   * 
   * @param  DateInterface|mixed $date raw datetime data
   * @return DateTimeWrapper new instance
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public static function from($date = null): DateTimeWrapper {
    return new static($date);
  }

}
