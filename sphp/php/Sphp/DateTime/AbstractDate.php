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
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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

  public function format(string $format): string {
    $output = $this->getDateTime()->format($format);
    if ($output === false) {
      throw new InvalidArgumentException('Invalid format string: ' . $format);
    }
    return $output;
  }

  /**
   * Returns the Unix timestamp
   * 
   * @return int the Unix timestamp
   */
  public function getTimestamp(): int {
    return $this->getDateTime()->getTimestamp();
  }

  public function getWeekDay(): int {
    return (int) $this->getDateTime()->format('N');
  }

  public function getWeekDayName(): string {
    return $this->getDateTime()->format('l');
  }

  public function getWeek(): int {
    return (int) $this->getDateTime()->format('W');
  }

  public function getMonth(): int {
    return (int) $this->getDateTime()->format('m');
  }

  public function getMonthName(): string {
    return $this->getDateTime()->format('F');
  }

  public function getMonthDay(): int {
    return (int) $this->getDateTime()->format('j');
  }

  public function getYear(): int {
    return (int) $this->getDateTime()->format('Y');
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

  /**
   * Checks whether the week is the current week
   * 
   * @return bool true if the week number is current, false otherwise
   */
  public function isCurrentWeek(): bool {
    $today = date('Y-m-W');
    $thisDay = $this->getDateTime()->format('Y-m-W');
    return $today === $thisDay;
  }

  public function dateEqualsTo($date): bool {
    try {
      $parsed = DateTimes::parseDateString($date);
      return $parsed === $this->getDateTime()->format('Y-m-d');
    } catch (Exception $ex) {
      return false;
    }
  }

}
