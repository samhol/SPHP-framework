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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DateTime extends AbstractDate implements DateTimeInterface {

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
      parent::__construct($time);
    } else {
      try {
        $dateTime = DateTimes::dateTimeImmutable($time);
        parent::__construct($dateTime);
      } catch (Exception $ex) {
        throw new InvalidArgumentException($ex->getMessage(), $ex->getCode(), $ex);
      }
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->reflector);
    parent::__destruct();
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->reflector = null;
    parent::__clone();
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
      $this->reflector = new ReflectionClass($this->getDateTime());
    }
    if (!$this->reflector->hasMethod($name)) {
      throw new BadMethodCallException("Method $name does not exist");
    } else {
      $reflectionMethod = $this->reflector->getMethod($name);
      $result = $reflectionMethod->invokeArgs($this->getDateTime(), $args);
      if ($result instanceof DateTimeImmutable) {
        return new static($result);
      } else {
        return $result;
      }
    }
  }

  public function __toString(): string {
    return $this->format(\DateTime::ATOM);
  }

  public function diff($date, bool $absolute = false): Interval {
    if ($date instanceof DateInterface && !$date instanceof DateTimeInterface) {
      return (new Date($this->format('Y-m-d')))->diff($date, $absolute);
    } else {
      $other = DateTimes::dateTimeImmutable($date);
      $diff = $this->getDateTime()->diff($other, $absolute);
      return Intervals::fromDateInterval($diff);
    }
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
   * Returns the difference in days between this and another date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return int the difference in days
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = static::from($date)->getTimestamp();
    $timeStamp = $this->getTimestamp();
    $result = $timeStamp <=> $dt;
    return $result;
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
    $dt = $this->getDateTime()->add(Intervals::create($interval));
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
    $dt = $this->getDateTime()->sub(Intervals::create($interval));
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

  public function getTimeZoneOffset(): int {
    return $this->getDateTime()->getOffset();
  }

  public function getTimeZoneName(): string {
    return $this->getDateTime()->getTimezone()->getName();
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
