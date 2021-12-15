<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateTimeImmutable;

/**
 * Defines properties for a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface DateTime extends Date {

  /**
   * Returns the difference between this and another date
   * 
   * @param  Date $date another date
   * @return int the difference
   */
  public function compareTo(Date $date): int;

  public function getDateTime(): DateTimeImmutable;

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int;

  /**
   * Returns the Unix timestamp with microseconds
   * 
   * @return float the Unix timestamp with microseconds
   */
  public function getMicrotime(): float;

  /**
   * Returns the number of hours
   * 
   * @return int the number of hours
   */
  public function getHours(): int;

  /**
   * Returns the number of minutes
   * 
   * @return int the number of minutes
   */
  public function getMinutes(): int;

  /**
   * Returns the number of seconds
   * 
   * @return int the number of seconds
   */
  public function getSeconds(): int;

  /**
   * Returns the number of microseconds
   * 
   * @return int the number of microseconds
   */
  public function getMicroseconds(): int;

  /**
   * Sets the time
   * 
   * @param  int $hour Hour of the time
   * @param  int $minute Minute of the time
   * @param  int $second Second of the time
   * @param  int $microsecond Microsecond of the time
   * @return DateTime modified instance
   */
  public function setTime(int $hour, int $minute, int $second = 0, int $microsecond = 0): DateTime;

  /**
   * Creates a new object with modified timestamp
   *  
   * @param  string $modify a date/time string
   * @return DateTime new instance
   * @throws InvalidArgumentException if formatting fails
   * @link   https://www.php.net/manual/en/datetime.formats.php Valid Date and Time Formats
   */
  public function modify(string $modify): DateTime;

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTime new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function add($interval): DateTime;

  /**
   * Adds an amount of days, months, years, hours, minutes and seconds
   * 
   * @param  string|Interval|DateInterval $interval the interval to add
   * @return DateTime new instance
   * @throws InvalidArgumentException if the interval cannot be parsed from the input
   */
  public function sub($interval): DateTime;
}
