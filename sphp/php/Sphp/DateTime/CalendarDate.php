<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use Sphp\DateTime\Holidays\BirthDay;
use Sphp\DateTime\Holidays\Holiday;

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
  private $collection = [];

  public function __construct(Date $date = null) {
    if ($date === null) {
      $date = new Date();
    }
    $this->date = $date;
    $this->collection[BirthDay::class] = [];
    $this->collection[Holiday::class] = [];
  }

  public function getDate(): Date {
    return $this->date;
  }

  public function addBirthday($person) {
    if (!in_array($person, $this->collection[BirthDay::class], true)) {
      $this->collection[BirthDay::class][] = new BirthDay($this->date, $person);
    }
  }

  public function hasBirthDays(): bool {
    return !empty($this->collection[BirthDay::class]);
  }

  public function getBirthdays(): array {
    return $this->collection[BirthDay::class];
  }

  public function addHoliday(string $desc) {
    return $this->collection[Holiday::class][] = new Holiday($this->date, $desc);
  }

  public function merge(DateWithData $dateWithData) {
    if ($dateWithData->getDate()->equals($this->getDate()) && !$this->contains($dateWithData)) {
      foreach ($dateWithData as $evt) {
        $this->addEvent($evt);
      }
    }
  }

  public function addEvent(Holiday $event) {
    if ($event->getDate()->equals($this->getDate()) && !$this->contains($event)) {
      $this->collection[] = $event;
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
      foreach ($this->collection as $day) {
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
      $output .= "Birthdays:\n";
      foreach ($this->collection[BirthDay::class] as $item) {
        $output .= "\t{$item->getName()}\n";
      }
    }
    foreach ($this->collection[Holiday::class] as $item) {
      $output .= "Holiday: {$item->getName()}\n";
    }
    return $output;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->collection);
  }

}
