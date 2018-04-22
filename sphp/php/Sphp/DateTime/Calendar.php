<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

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
      $this->mergeDateData($group);
    }
  }

  public function mergeDateData(CalendarDate $day) {
    $key = $day->getDate()->format('Y-m-d');
    if (!$this->hasSpecialDays($day->getDate())) {
      $this->days[$key] = $day;
    } else {
      $this->days[$key]->merge($day);
    }
    return $this;
  }

  public function addHoliday($date, string $name): Holiday {
    $this->setCalendarDate($date)->addHoliday($name);
    return $holiday;
  }

  protected function setCalendarDate($date): CalendarDate {
    $key = $date->parseKey($date);
    if ($this->contains($key)) {
      return $this->days[$key];
    } else {
      $this->days[$key] = new CalendarDate($date);
    }
  }

  public function add(CalendarDate $day) {
    $key = $day->getDate()->format('Y-m-d');
    if (!$this->contains($day)) {
      $this->days[$key] = $day;
    }
    return $this;
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
      $key = $date;
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
  public function hasSpecialDays(Date $date): bool {
    $key = $this->parseKey($date);
    return array_key_exists($key, $this->days);
  }

  /**
   * 
   * @param Date $date
   */
  public function get(Date $date): CalendarDate {
    $key = $this->parseKey($date);
    if ($this->contains($key)) {
      return $this->days[$key];
    }
    return new CalendarDate();
  }

  public function getIterator(): \Traversable {
    ksort($this->days);
    return new \ArrayObject($this->days);
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
