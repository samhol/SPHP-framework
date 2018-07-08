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
trait DateTrait {

  /**
   * Returns the inner immutable datetime object
   * 
   * @return DateTimeImmutable the inner immutable datetime object
   */
  abstract public function getDateTime(): DateTimeImmutable;

  public function getTimestamp(): int {
    return $this->getDateTime()->getTimestamp();
  }

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws DateTimeException if formatting fails
   */
  public function format(string $format): string {
    $output = $this->getDateTime()->format($format);
    if ($output === false) {
      throw new DateTimeException();
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

  public function getWeek(): int {
    return (int) $this->format('W');
  }

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

  public function getYear(): int {
    return (int) $this->format('Y');
  }

  public function isCurrentDate(): bool {
    $today = date('Y-m-d');
    $thisDay = $this->getDateTime()->format('Y-m-d');
    return $today === $thisDay;
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
    $diff = $this->getDateTime()->diff($dt);
    $result = $diff->d;
    if ($diff->invert === 1) {
      $result = -$result;
    }
    return $result;
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

}
