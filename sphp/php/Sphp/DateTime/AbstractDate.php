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
use Exception;

/**
 * Implements a date object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractDate implements DateInterface {

  /**
   * @var DateTimeImmutable 
   */
  private $dateTime;

  /**
   * Constructor
   * 
   * @param  mixed $dateTime raw date data
   */
  public function __construct(DateTimeImmutable $dateTime) {
    $this->dateTime = $dateTime;
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
      throw new InvalidArgumentException('Invalid format string: ' . $format);
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
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isLaterThan($date): bool {
    return $this->compareTo($date) > 0;
  }

  /**
   * Checks if this date is earlier than the given one
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date the date to match
   * @throws InvalidArgumentException if date cannot be parsed from input
   */
  public function isEarlierThan($date): bool {
    return $this->compareTo($date) < 0;
  }

}
