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
    $this->notes[BirthDay::class] = [];
    $this->notes[Holiday::class] = [];
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function addBirthday($person) {
    if (!in_array($person, $this->notes[BirthDay::class], true)) {
      $this->notes[BirthDay::class][] = new BirthDay($this->date, $person);
    }
  }

  public function hasBirthDays(): bool {
    return !empty($this->notes[BirthDay::class]);
  }

  public function getBirthdays(): array {
    return $this->notes[BirthDay::class];
  }

  public function addHoliday(string $desc): Holiday {
    $holiday = new Holiday($this->date, $desc);
    $this->notes[Holiday::class][] = $holiday;
    return $holiday;
  }

  public function hasHolidays(): bool {
    return !empty($this->notes[Holiday::class]);
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
      $this->notes[] = $event;
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
    if ($this->hasBirthDays()) {
      $output .= "  Birthdays:\n";
      foreach ($this->notes[BirthDay::class] as $item) {
        $output .= "    {$item->getName()}\n";
      }
    }
    if ($this->hasHolidays()) {
      $output .= "  Holidays:\n";
      foreach ($this->notes[Holiday::class] as $item) {
        $output .= "   {$item->getName()}\n";
      }
    }
    return $output;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->notes);
  }

}
