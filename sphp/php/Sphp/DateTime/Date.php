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
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Implements a date object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Date extends AbstractDate {

  /**
   * Constructor
   * 
   * @param  mixed $date raw date data
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function __construct($date = null) {
    try {
      $dateTime = new DateTimeImmutable(DateTimes::parseDateString($date));
      parent::__construct($dateTime);
    } catch (\Exception $ex) {
      throw new InvalidArgumentException(static::class . ' object cannot be parsed from input type', $ex->getCode(), $ex);
    }
  }

  public function __toString(): string {
    return $this->format('Y-m-d');
  }

  public function diff($date, bool $absolute = false): Interval {
    try {
      $other = Date::from($date)->getDateTime();
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('The date to compare to is invalid', $ex->getCode(), $ex);
    }
    $diff = $this->getDateTime()->diff($other, $absolute);
    return Intervals::fromDateInterval($diff);
  }

  /**
   * Returns the difference in days between this and another date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return int the difference in days
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = Date::from($date)->format('Ymd');
    $timeStamp = $this->format('Ymd');
    $result = $timeStamp <=> $dt;
    return $result;
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
    $new = $this->getDateTime()->modify($modify);
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
