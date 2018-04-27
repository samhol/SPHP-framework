<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Events\Exceptions\NoteException;

/**
 * Description of NoteCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EventCollection extends AbstractEventCollection {

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   * @throws NoteException
   */
  public function insertHoliday($date, $content): Holiday {
    $holiday = new Holiday(Date::from($date), $content);
    $inserted = $this->insertNote($holiday);
    if (!$inserted) {
      throw new NoteException('Holiday could not be inserted to the collection');
    }
    return $holiday;
  }


  /**
   * 
   * @param  CalendarDateInfo $notes
   * @return $this 
   */
  public function mergeNotes(EventCollection $notes) {
    foreach ($notes as $note) {
      $this->insertNote($note);
    }
    return $this;
  }


  public function getNotesForDate($date): array {
    $notes = [];
    $parsed = Date::from($date);
    foreach ($this as $note) {
      if ($note->dateMatchesWith($parsed)) {
        $notes[] = $note;
      }
    }
    return $notes;
  }

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   * @throws NoteException
   */
  public function insertBirthday(int $day, int $month, $person): BirthDay {
    $birthDay = new BirthDay($month, $day, $person);
    $inserted = $this->insertNote($birthDay);
    if (!$inserted) {
      throw new NoteException('Birthday could not be inserted to the collection');
    }
    return $birthDay;
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array {
    return array_filter($this->collection, function ($item) {
      return $item instanceof BirthDay;
    });
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->collection);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->collection);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key() {
    return key($this->collection);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->collection);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->collection);
  }

}
