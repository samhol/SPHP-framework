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
use Sphp\DateTime\Exceptions\DateTimeException;

/**
 * Collection for calendar date notes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarDateNotes implements IteratorAggregate {

  /**
   * @var Date 
   */
  private $date;

  /**
   * @var array 
   */
  private $notes = [];

  /**
   * Constructor
   * 
   * @param Date $date
   */
  public function __construct(Date $date) {
    $this->date = $date;
    $this->notes = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->notes);
  }

  /**
   * Returns the plain date object
   * 
   * @return Date the plain date object
   */
  public function getDate(): Date {
    return $this->date;
  }

  /**
   * 
   * @param  CalendarDateNote $note
   * @return CalendarDateNote inserted instance
   * @throws DateTimeException id the note is for a different day
   */
  public function set(CalendarDateNote $note): CalendarDateNote {
    if (!$this->dateMatch($note)) {
      throw new DateTimeException("Note $note has wrong date");
    }
    if (!in_array($note, $this->notes, true)) {
      $this->notes[] = $note;
      return $note;
    } else {
      throw new DateTimeException("Note $note allready exists");
    }
  }

  public function dateMatch(CalendarDateNote $note): bool {
    return $note->getDate()->matchesWith($this->getDate());
  }

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   */
  public function setBirthday($person): BirthDay {
    $holiday = new BirthDay($this->date, $person);
    return $this->set($holiday);
  }

  /**
   * 
   * @return bool
   */
  public function hasBirthDays(): bool {
    return !empty($this->getBirthdays());
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array {
    return array_filter($this->notes, function ($item) {
      return $item instanceof BirthDay;
    });
  }

  /**
   * 
   * @param  string $desc
   * @return Holiday
   */
  public function setHoliday(string $desc): Holiday {
    $holiday = new Holiday($this->date, $desc);
    return $this->set($holiday);
  }

  /**
   * Returns all national holiday notes stored
   * 
   * @return Holiday[] all national holiday notes stored
   */
  public function getNationalHolidays(): array {
    return array_filter($this->notes, function ($item) {
      return $item instanceof Holiday && $item->isNationalHoliday();
    });
  }

  /**
   * Returns all notes stored
   * 
   * @return Holiday[] all holiday notes stored
   */
  public function getHolidays(): array {
    return array_filter($this->notes, function ($item) {
      return $item instanceof Holiday;
    });
  }

  /**
   * 
   * @return bool
   */
  public function hasHolidays(): bool {
    return !empty($this->notes);
  }

  /**
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->notes);
  }

  /**
   * 
   * @return bool
   */
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

  /**
   * 
   * @return bool
   */
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

  /**
   * 
   * @param  CalendarDateInfo $dateWithData
   * @return $this 
   */
  public function merge(CalendarDateInfo $dateWithData) {
    if ($dateWithData->getDate()->matchesWith($this->getDate()) && !$this->contains($dateWithData)) {
      foreach ($dateWithData as $evt) {
        $this->addEvent($evt);
      }
    }
    return $this;
  }

  /**
   * 
   * @param CalendarDateNote $event
   */
  public function addNote(CalendarDateNote $event) {
    if ($event->getDate()->matchesWith($this->getDate()) && !$this->contains($event)) {
      $this->add($event);
    }
  }

  /**
   * 
   * @param  CalendarDateNote $date
   * @return bool 
   */
  public function contains(CalendarDateNote $date): bool {
    $contains = false;
    if ($date->getDate()->matchesWith($this->getDate())) {
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

  /**
   * Create a new iterator to iterate through the notes
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new \ArrayIterator($this->notes);
  }

}
