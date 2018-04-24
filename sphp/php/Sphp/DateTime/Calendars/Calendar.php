<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use IteratorAggregate;
use Sphp\DateTime\Date;
use Traversable;

/**
 * Description of Calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Calendar implements IteratorAggregate, TraversableCalendar {

  /**
   * @var CalendarDate[]
   */
  private $days;

  public function __construct() {
    $this->days = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->days);
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->days = clone $this->days;
  }

  public function mergeCalendar(TraversableCalendar $days) {
    foreach ($days as $group) {
      $this->mergeDate($group);
    }
    return $this;
  }

  public function mergeDate(CalendarDate $date): CalendarDate {
    //$key = $this->parseKey($date);
    if (!$this->contains($date)) {
      return $this->setDate($date);
    } else {
      return $this->get($date)->mergeNotes($date);
    }
  }

  protected function createCalendarDate($date): CalendarDate {
    $key = $this->parseKey($date);
    if (!$this->contains($date)) {
      $calendarDate = new CalendarDate($date);
      return $this->setDate($calendarDate);
    } else if ($date instanceof CalendarDate) {
      return $this->get($date)->mergeNotes($date);
    } else if ($date instanceof Holiday) {
      $calDate = $this->get($date);
      $calDate->getInfo()->setHoliday($date);
      return $calDate;
    } else {
      return $this->get($date);
    }
  }

  public function setHoliday($date, string $name): Holiday {
    $holiday = $this->createCalendarDate($date)->getInfo()->setHoliday($name);
    return $holiday;
  }

  public function setBirthDay($date, string $name): Holiday {
    $holiday = $this->createCalendarDate($date)->getInfo()->setBirthday($name);
    return $holiday;
  }

  public function setDate(CalendarDate $date): CalendarDate {
    $key = $this->parseKey($date);
    $this->days[$key] = $date;
    return $this->days[$key];
  }

  protected function parseKey($date): string {
    $key = '';
    if ($date instanceof \DateTimeInterface) {
      $key = $date->format('Y-m-d');
    } else if ($date instanceof Date) {
      $key = $date->format('Y-m-d');
    } else if ($date instanceof CalendarDate) {
      $key = $date->getDate()->format('Y-m-d');
    } else if (is_float($date)) {
      $key = Date::fromTimestamp($date)->format('Y-m-d');
    } else if (is_string($date)) {
      $key = Date::fromString($date)->format('Y-m-d');
    }
    return $key;
  }

  /**
   * 
   * @param  CalendarDate|string|int $date
   * @return bool 
   */
  public function contains($date): bool {
    $key = $this->parseKey($date);
    return array_key_exists($key, $this->days);
  }

  /**
   * 
   * @param Date $date
   * @etun CalendarDate
   */
  public function get($date): CalendarDate {
    $key = $this->parseKey($date);
    if (!array_key_exists($key, $this->days)) {
      $this->days[$key] = new CalendarDate($date);
    }
    return $this->days[$key];
  }

  /**
   * 
   * @return \Traversable
   */
  public function getIterator(): \Traversable {
    ksort($this->days);
    return new \ArrayIterator($this->days);
  }

}
