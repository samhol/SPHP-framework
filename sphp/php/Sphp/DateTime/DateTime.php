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
      } else if ($date instanceof DTI) {
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

  public function getDateTime(): DateTimeImmutable {
    return $this->dateTime;
  }

  /**
   * Returns the difference in days between this and another date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return int the difference in days
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function compareTo($date): int {
    $dt = DateTime::from($date)->getTimestamp();
    $timeStamp = $this->getTimestamp();
    $result = $timeStamp - $dt;
    return $result;
  }

  public function equals($date): bool {
    return $this->compareTo($date) === 0;
  }

  /**
   * Checks if this date is later than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @return bool true if this date is later than the given one and false otherwise
   * @throws DateTimeException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->compareTo($date) < 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param DateInterface|DateTimeInteface|string|int|null $date the date to match
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
   * @return Date new instance
   */
  public function jumpHours(int $hours): DateTime {
    return $this->modify("$hours hours");
  }

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return Date new instance
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
   * 
   * @return DateTime new instance
   */
  public function firstOfMonth(): DateTime {
    return $this->modify('first day of this month');
  }

  /**
   * Returns the previous Date
   *  
   * @param  string $modify
   * @return DateTime new instance
   * @throws DateTimeException if formatting fails
   */
  public function modify(string $modify): DateTime {
    $thrower = ErrorToExceptionThrower::getInstance(DateTimeException::class);
    $thrower->start();
    $new = $this->dateTime->modify($modify);
    $thrower->stop();
    return static::from($new);
  }

  /**
   * Creates a new instance from input
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw datetime data
   * @return DateTime new instance
   * @throws DateTimeException if date cannot be parsed from input
   */
  public static function from($date = null): DateTime {
    try {
      $dateTime = null;
      if (is_string($date)) {
        $dateTime = new DateTime($date);
      } else if (is_int($date)) {
        $dateTime = (new DateTime())->setTimestamp($date);
      } else if ($date instanceof DateInterface || $date instanceof DTI) {
        $dateTime = new DateTime($date->format(DATE_ATOM));
      } else if (is_null($date)) {
        $dateTime = new DateTime();
      }
    } catch (\Exception $ex) {
      throw new DateTimeException($ex->getMessage(), $ex->getCode(), $ex);
    }

    if ($dateTime === null) {
      throw new DateTimeException(static::class . ' object cannot be parsed from input type');
    }
    return $dateTime;
  }

  public function __toString(): string {
    
  }

  public function getHours(): int {
    return (int) $this->format('h');
  }

}
