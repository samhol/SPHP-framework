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
 * Description of CalendarDate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarDate {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var array 
   */
  private $notes = [];

  public function __construct($date = null) {
    if ($date instanceof \DateTimeInterface) {
      $date = new Date($date);
    } else if ($date instanceof Date) {
      $date = $date;
    } else if ($date instanceof CalendarDate) {
      $date = $date->getDate();
    } else if (is_float($date)) {
      $date = Date::fromTimestamp($date)->format('Y-m-d');
    } else if (is_string($date)) {
      $date = Date::fromString($date);
    } else {
      $date = new Date();
    }
    $this->date = $date;
    $this->notes = [];
  }

  public function getDate(): Date {
    return $this->date;
  }

  /**
   * 
   * @param \Sphp\DateTime\Calendars\Holiday $holiday
   * @return \Sphp\DateTime\Calendars\Holiday
   * @throws \Exception
   */
  protected function add(Holiday $holiday) {
    if (!$holiday->getDate()->equals($this->getDate())) {
      throw new \Exception("holiday $holiday has wrong date");
    }
    if (!in_array($holiday, $this->notes, true)) {
      $this->notes[] = $holiday;
      return $holiday;
    } else {
      throw new \Exception("holiday $holiday allready exists");
    }
  }

  /**
   * 
   * @param  string $person
   * @return \Sphp\DateTime\Calendars\BirthDay
   */
  public function addBirthday($person): BirthDay {
    $holiday = new BirthDay($this->date, $person);
    return $this->add($holiday);
  }

  public function hasBirthDays(): bool {
    return !empty($this->getBirthdays());
  }

  public function getBirthdays(): array {
    return array_filter($this->notes, function ($item) {
      return $item instanceof BirthDay;
    });
  }

  public function addHoliday(string $desc): Holiday {
    $holiday = new Holiday($this->date, $desc);
    return $this->add($holiday);
  }

  public function getNationalHolidays(): array {
    return array_filter($this->notes, function ($item) {
      return $item instanceof Holiday && $item->isNationalHoliday();
    });
  }

  public function getHolidays(): array {
    return $this->notes;
  }

  public function hasHolidays(): bool {
    return !empty($this->notes);
  }

  public function hasInfo(): bool {
    return !empty($this->notes);
  }

  public function isNationalHoliday(): bool {
    $isNational = false;
    foreach ($this->getHolidays() as $holiday) {
      if ($holiday->isNationalHoliday()) {
        $isNational = true;
        break;
      }
    }
    return $isNational;
  }

  public function isFlagDay(): bool {
    $isNational = false;
    foreach ($this->notes as $holiday) {
      if ($holiday->isFlagDay()) {
        $isNational = true;
        break;
      }
    }
    return $isNational;
  }

  public function merge(CalendarDate $dateWithData) {
    if ($dateWithData->getDate()->equals($this->getDate()) && !$this->contains($dateWithData)) {
      foreach ($dateWithData as $evt) {
        $this->addEvent($evt);
      }
    }
  }

  public function addEvent(Holiday $event) {
    if ($event->getDate()->equals($this->getDate()) && !$this->contains($event)) {
      $this->add($event);
    }
  }

  /**
   * 
   * @param  Holiday $date
   * @return bool 
   */
  public function contains(Holiday $date): bool {
    $contains = false;
    if ($date->getDate()->equals($this->getDate())) {
      foreach ($this->notes as $day) {
        if ($day == $date) {
          $contains = true;
          break;
        }
      }
      return $contains;
    }
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this->notes as $note) {
      // print_r($note);
      $output .= "  $note\n";
    }
    return $output;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->notes);
  }

}
