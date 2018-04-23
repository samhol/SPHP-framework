<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\Date;

/**
 * Description of Calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Calendar implements \IteratorAggregate, \ArrayAccess {

  /**
   * @var CalendarDate[]
   */
  private $days;

  public function __construct() {
    $this->days = [];
  }

  public function merge(Calendar $days) {
    foreach ($days as $key => $group) {
      $this->mergeDate($group);
    }
  }

  public function mergeDate(CalendarDate $date) {
    $key = $this->parseKey($date);
    if (!$this->contains($key)) {
      $this->days[$key] = $date;
    } else {
      $this->days[$key]->merge($date);
    }
    return $this;
  }

  public function addHoliday($date, string $name): Holiday {
    $holiday = $this->setCalendarDate($date)->addHoliday($name);
    return $holiday;
  }

  public function addBirthDay($date, string $name): Holiday {
    $holiday = $this->setCalendarDate($date)->addBirthday($name);
    return $holiday;
  }

  protected function setCalendarDate($date): CalendarDate {
    $key = $this->parseKey($date);
    if (!array_key_exists($key, $this->days)) {
      $this->days[$key] = new CalendarDate($date);
    }
    return $this->days[$key];
  }

  public function add(CalendarDate $date): CalendarDate {
    $key = $this->parseKey($date);
    if (!$this->contains($date)) {
      $this->days[$key] = $date;
    }
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
   * @param  Date $date
   * @return bool 
   */
  public function hasSpecialDays($date): bool {
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

  public function getIterator(): \Traversable {
    ksort($this->days);
    return new \ArrayIterator($this->days);
  }

  public function offsetExists($offset): bool {
    $date = Date::fromString($offset);
    return array_key_exists("$date", $this->days);
  }

  public function offsetGet($offset) {
    if ($this->offsetExists($offset)) {
      return $this->days[$offset];
    }
  }

  public function offsetSet($offset, $value): void {
    
  }

  public function offsetUnset($offset): void {
    
  }

}
