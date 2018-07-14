<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\DateTime\Exceptions\DateTimeException;

/**
 * Defines properties for a date
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface DateInterface {

  /**
   * Returns the string representation of the object
   * 
   * @return string the string representation of the object
   */
  public function __toString(): string;

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int;

  /**
   * Returns the number of the weekday
   * 
   * @return int the number of the weekday
   */
  public function getWeekDay(): int;

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
   * Checks if the input matches the object 
   * 
   * @param  mixed $date the date to match
   * @return bool true if matches and false otherwise
   */
  public function equals($date): bool;

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws DateTimeException if formatting fails
   */
  public function format(string $format): string;
}
