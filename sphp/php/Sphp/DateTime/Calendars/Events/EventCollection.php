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

  private $listeners = [];

  public function addListener( $l) {
    $this->listeners[] = $l;
  }

  public function triggerInsert(Event $event) {
    foreach ($this->listeners as $listener) {
      if ($listener instanceof CalendarEventListener) {
        $listener->onEventInsert($event);
      } else {
        $listener($event);
      }
    }
  }

  public function insertEvent(Event $event): bool {
    $inserted = parent::insertEvent($event);
    if ($inserted) {
      $this->triggerInsert($event);
    }
    return $inserted;
  }

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   * @throws NoteException
   */
  public function insertHoliday($date, $content): Holiday {
    $holiday = new Holiday(Date::from($date), $content);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new NoteException('Holiday could not be inserted to the collection');
    }
    return $holiday;
  }

  /**
   * 
   * @param  int $month
   * @param  int $day
   * @param  string $name
   * @return AnnualHoliday
   * @throws NoteException
   */
  public function insertAnnualHoliday(int $month, int $day, string $name): AnnualHoliday {
    $holiday = Events::annualHoliday($month, $day, $name);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new NoteException('Annual Holiday could not be inserted to the collection');
    }
    return $holiday;
  }

  /**
   * 
   * @param  string $format
   * @param  string $name
   * @return VaryingAnnualHoliday
   * @throws NoteException
   */
  public function insertVaryingAnnualHoliday(string $format, string $name): VaryingAnnualHoliday {
    $holiday = Events::varyingAnnualHoliday($format, $name);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new NoteException('Varying Annual Holiday could not be inserted to the collection');
    }
    return $holiday;
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
  public function insertBirthday(int $month, int $day, $person, int $yearOfBirth = null): BirthDay {
    $birthDay = new BirthDay($month, $day, $person, $yearOfBirth);
    $inserted = $this->insertEvent($birthDay);
    if (!$inserted) {
      throw new NoteException('Birthday could not be inserted to the collection');
    }
    return $birthDay;
  }

}
