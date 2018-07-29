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
use DateTimeInterface as DTI;
use Sphp\DateTime\Exceptions\DateTimeException;
use Exception;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use ReflectionClass;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a datetime object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTime implements DateTimeInterface {

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
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function __construct($time = null) {
    try {
      $this->dateTime = Factory::dateTimeImmutable($time);
    } catch (Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
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
   * Clone method
   */
  public function __call($name, $args) {
    if ($this->reflector === null) {
      $this->reflector = new ReflectionClass($this->dateTime);
    }
    if (!$this->reflector->hasMethod($name)) {
      throw new BadMethodCallException("Method $name does not exist");
    } else {
      $reflectionMethod = $this->reflector->getMethod($name);
      return $reflectionMethod->invokeArgs($this->dateTime, $args);
    }
    // $this->reflector->getMethod($name)->
    return true;
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
   * @throws DateTimeException if date cannot be parsed from input
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
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->compareTo($date) < 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  mixed $date the date to match
   * @return bool true if this date is earlier than the given one and false otherwise
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->compareTo($date) > 0;
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
    return $this->modify("+ $days day");
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
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return DateTime new instance
   * @throws DateTimeException if formatting fails
   * @link   http://php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): DateTime {
    $thrower = ErrorToExceptionThrower::getInstance(DateTimeException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
    $thrower->stop();
    return static::from($new);
  }

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTime new instance
   * @throws DateTimeException if the interval cannot be parsed from the input
   */
  public function add($interval): DateTime {
    if (is_string($interval)) {
      $interval = new Interval($interval);
    } if (!$interval instanceof \DateInterval) {
      throw new DateTimeException('The interval cannot be parsed from the input');
    }
    $dt = $this->dateTime->add($interval);
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
   * @return DateTime new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($date = null): DateTime {
    return new static($date);
  }

}
