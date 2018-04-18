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

/**
 * Description of DateTimeWrapper
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Date {

  /**
   * @var DateTimeInterface 
   */
  private $dateTime;

  public function __construct(DateTimeInterface $dateTime = null) {
    if ($dateTime === null) {
      $dateTime = new DateTimeImmutable();
    } else if (!$dateTime instanceof DateTimeImmutable) {
      $dateTime = DateTimeImmutable::createFromMutable($dateTime);
    }
    $this->dateTime = $dateTime;
  }

  public function getWeekDay(): int {
    return (int) $this->dateTime->format('N');
  }

  public function getWeekDayName(): string {
    return $this->dateTime->format('l');
  }

  /**
   * 
   * @return int
   */
  public function getMonth(): int {
    return (int) $this->dateTime->format('m');
  }

  /**
   * 
   * @return string
   */
  public function getMonthName(): string {
    return $this->dateTime->format('F');
  }

  /**
   * 
   * @return int
   */
  public function getMonthDay(): int {
    return (int) $this->dateTime->format('j');
  }

  /**
   * 
   * @return int
   */
  public function getYear(): int {
    return (int) $this->dateTime->format('Y');
  }

  /**
   * 
   * @param  mixed $date
   * @return bool
   */
  public function equals($date): bool {
    if (is_string($date)) {
      $date = static::createFromString($date);
    } else if (is_int($date)) {
      $date = static::createFromTimestamp($date);
    }
    if ($date instanceof DateTimeInterface || $date instanceof Date) {
      return $date->format('Y-m-d') === $this->format('Y-m-d');
    }
    return false;
  }

  /**
   * 
   * @param string $format
   * @return string
   */
  public function format(string $format): string {
    return $this->dateTime->format($format);
  }

  /**
   * Returns the next Date
   * 
   * @return Date
   */
  public function nextDate(): Date {
    $next = $this->dateTime->modify('+ 1 day');
    return new Date($next);
  }

  /**
   * Returns the previous Date
   * 
   * @return Date
   */
  public function previousDate(): Date {
    $prev = $this->dateTime->modify('- 1 day');
    return new Date($prev);
  }

  public static function create(int $day = null, int $month = null, int $year = null): Date {
    if ($year === null) {
      $year = date('Y');
    }
    if ($month === null) {
      $month = date('D');
    }
    if ($day === null) {
      $day = date('j');
    }
    $date = new DateTimeImmutable("$year-$month-$day");
    return new static($date);
  }

  /**
   * 
   * @param  string $date
   * @return Date
   */
  public static function createFromString(string $date): Date {
    return new static(new DateTimeImmutable($date));
  }

  /**
   * 
   * @param  int $unixtimestamp
   * @return Date
   */
  public static function createFromTimestamp(int $unixtimestamp): Date {
    $date = new DateTimeImmutable();
    $date->setTimestamp($unixtimestamp);
    return new static($date);
  }

}
