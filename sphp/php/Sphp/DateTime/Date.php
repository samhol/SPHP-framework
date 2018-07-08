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
use Sphp\DateTime\Exceptions\DateTimeException;
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

  use DateTrait;

  /**
   * @var DateTimeImmutable 
   */
  private $dateTime;

  /**
   * Constructor
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function __construct($date = null) {
    try {
      $dateTime = null;
      if (is_string($date)) {
        $dateTime = new DateTimeImmutable($date);
      } else if (is_int($date)) {
        $dateTime = (new DateTimeImmutable())->setTimestamp($date);
      } else if ($date instanceof DateInterface) {
        $dateTime = new DateTimeImmutable($date->toDateString());
      } else if ($date instanceof DateTimeInterface) {
        $dateTime = $date;
      } else if (is_null($date)) {
        $dateTime = new DateTimeImmutable('today');
      }
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    if ($dateTime === null) {
      throw new DateTimeException(static::class . ' object cannot be parsed from input type');
    }
    $this->dateTime = new DateTimeImmutable($dateTime->format('Y-m-d'));
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

  public function toDateString(): string {
    return $this->format('Y-m-d');
  }

  public function __toString(): string {
    return $this->toDateString();
  }

  /**
   * 
   * @return DateTimeImmutable
   */
  public function getDateTime(): DateTimeImmutable {
    return clone $this->dateTime;
  }

  /**
   * Returns the difference in days between this and another date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return int the difference in days
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function diff($date): int {
    $dt = Date::from($date)->getDateTime();
    $diff = $this->dateTime->diff($dt);
    $result = $diff->d;
    if ($diff->invert === 1) {
      $result = -$result;
    }
    return $result;
  }

  public function equals($date): bool {
    if (!$date instanceof DateInterface) {
      try {
        $date = Date::from($date);
      } catch (Exception $ex) {
        return false;
      }
    }
    return $date->format('Y-m-d') === $this->format('Y-m-d');
  }

  /**
   * Checks if this date is later than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @return bool true if this date is later than the given one and false otherwise
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isLaterThan($date, bool $strict = true): bool {
    if ($strict) {
      return $this->diff($date) < 0;
    } else {
      return $this->diff($date) <= 0;
    }
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @param bool $strict true if equality is not allowed, false otherwise
   * @return bool true if this date is earlier than the given one and false otherwise
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isEarlierThan($date, bool $strict = true): bool {
    if ($strict) {
      return $this->diff($date) > 0;
    } else {
      return $this->diff($date) >= 0;
    }
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
   * @return DateTime new instance
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
   * Returns the previous Date
   *  
   * @param  string $modify
   * @return Date new instance
   * @throws DateTimeException if formatting fails
   */
  public function modify(string $modify): Date {
    $thrower = ErrorToExceptionThrower::getInstance(DateTimeException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
    $thrower->stop();
    return new Date($new);
  }

  /**
   * Creates a new instance
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return Date new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($date): Date {
    return new Date($date);
  }

}
