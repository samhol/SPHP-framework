<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * The Date Interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Date {

  /**
   * Returns the difference between two objects
   * 
   * @param  mixed $date The date to compare to
   * @param  bool $absolute Should the interval be forced to be positive?
   * @return Interval An instance representing the difference between the two dates
   * @throws InvalidArgumentException if the datetime to compare to is invalid
   */
  public function diff($date, bool $absolute = false): Interval;

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string;

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format 
   */
  public function format(string $format): string;

  /**
   * Returns the ISO-8601 numeric representation of the day of the week
   * 
   * @return int the number of the weekday
   */
  public function getWeekDay(): int;

  /**
   * Returns the name of the weekday
   * 
   * @return string the name of the weekday
   */
  public function getWeekDayName(): string;

  /**
   * Returns the week number 
   * 
   * @return int the week number 
   */
  public function getWeek(): int;

  /**
   * Returns the number of the month
   * 
   * @return int the number of the month
   */
  public function getMonth(): int;

  /**
   * Returns the name of the month
   * 
   * @return string the name of the month
   */
  public function getMonthName(): string;

  /**
   * Returns the day of the month
   * 
   * @return int the day of the month
   */
  public function getMonthDay(): int;

  /**
   * Returns the year
   * 
   * @return int the year
   */
  public function getYear(): int;

  /**
   * Checks whether the date is the current date
   * 
   * @return bool true if the date is the current date, false otherwise
   */
  public function isCurrentDate(): bool;

  /**
   * Checks whether the week is the current week
   * 
   * @return bool true if the week number is current, false otherwise
   */
  public function isCurrentWeek(): bool;

  /**
   * Checks whether the month is the current week
   * 
   * @return bool true if the month is current, false otherwise
   */
  public function isCurrentMonth(): bool;

  /**
   * Checks if the input matches the object 
   * 
   * @param  Date $date the date to match
   * @return bool true if matches and false otherwise
   */
  public function dateEqualsTo(Date $date): bool;

  /**
   * Returns the difference between this and another date
   * 
   * @param  Date $date another date
   * @return int the difference
   */
  public function compareDateTo(Date $date): int;

  /**
   * Advances given number of days and returns a new instance
   * 
   * @param  int $days number of days to shift
   * @return Date new instance
   */
  public function jumpDays(int $days): Date;

  /**
   * Advances given number of months and returns a new instance
   * 
   * @param  int $months number of months to shift
   * @return ImmutableDate new instance
   */
  public function jumpMonths(int $months): Date;

  /**
   * Advances given number of years and returns a new instance
   * 
   * @param  int $years number of years to shift
   * @return ImmutableDate new instance
   */
  public function jumpYears(int $years): Date;

  /**
   * Returns the date representing the first of the same month
   * 
   * @return Date new instance
   */
  public function firstOfMonth(): Date;

  /**
   * Returns the date representing the first of the same month
   * 
   * @return Date new instance
   */
  public function lastOfMonth(): Date;

  /**
   * Sets the date
   * 
   * @param  int $year Year of the date
   * @param  int $month Month of the date
   * @param  int $day Day of the date
   * @return Date modified instance
   */
  public function setDate(int $year, int $month, int $day): Date;
}
