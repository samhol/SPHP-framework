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
   * @param  mixed $date raw date data
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function __construct($date = null) {
    try {
      $this->dateTime = new DateTimeImmutable(static::parseDateString($date));
    } catch (\Exception $ex) {
      throw new DateTimeException(static::class . ' object cannot be parsed from input type', $ex->getCode(), $ex);
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

  public function __toString(): string {
    return $this->format('Y-m-d');
  }

  /**
   * Returns the inner immutable datetime object
   * 
   * @return DateTimeImmutable the inner immutable datetime object
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
    try {
      $parsed = static::parseDateString($date);
      return $parsed === $this->format('Y-m-d');
    } catch (Exception $ex) {
      return false;
    }
  }

  /**
   * Checks if this date is later than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->diff($date) < 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->diff($date) > 0;
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
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return Date new instance
   * @throws DateTimeException if formatting fails
   * @link   http://php.net/manual/en/datetime.formats.php Valid Date and Time Formats
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
   * @param  mixed $date raw date data
   * @return Date new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($date): Date {
    return new static($date);
  }

  /**
   * Parses a date string from input
   * 
   * @param  mixed $input input to parse
   * @return string date string as `Y-m-d` 
   * @throws DateTimeException if parsing fails
   */
  public static function parseDateString($input): string {
    $result = null;
    if (is_null($input)) {
      $result = date('Y-m-d');
    } else if (is_string($input)) {
      $result = (new DateTimeImmutable($input))->format('Y-m-d');
    } else if (is_int($input)) {
      $result = date('Y-m-d', $input);
    } else if ($input instanceof DateInterface || $input instanceof \DateTimeInterface) {
      $result = $input->format('Y-m-d');
    }
    if ($result === null) {
      throw new DateTimeException('Date string cannot be parsed from the input');
    }
    return $result;
  }

}
