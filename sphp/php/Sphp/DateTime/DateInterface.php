<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime;

/**
 * Defines DateInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface DateInterface {

  public function __toString(): string;

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
  public function isCurrent(): bool;

  /**
   * 
   * @param  mixed $date
   * @return bool
   */
  public function matchesWith($date): bool;

  /**
   * Returns date formatted according to given format
   * 
   * @param  string $format the format of the outputted date string
   * @return string date formatted according to given format
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function format(string $format): string;
}
