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
use Sphp\DateTime\Calendars\Events\Exceptions\CalendarEventException;

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
   * @throws CalendarEventException
   */
  public function insertHoliday($date, $content): UniqueHoliday {
    $holiday = new UniqueHoliday(Date::from($date), $content);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new CalendarEventException('Holiday could not be inserted to the collection');
    }
    return $holiday;
  }

  /**
   * 
   * @param  int $month
   * @param  int $day
   * @param  string $name
   * @return AnnualHoliday
   * @throws CalendarEventException
   */
  public function insertAnnualHoliday(int $month, int $day, string $name): AnnualHoliday {
    $holiday = Events::annualHoliday($month, $day, $name);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new CalendarEventException('Annual Holiday could not be inserted to the collection');
    }
    return $holiday;
  }

  /**
   * 
   * @param  int $month
   * @param  int $day
   * @param  string $name
   * @return AnnualHoliday
   * @throws CalendarEventException
   */
  public function insertWeeklyEvent(int $week, string $name): WeeklyHoliday {
    $holiday = Events::annualHoliday($month, $day, $name);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new CalendarEventException('Annual Holiday could not be inserted to the collection');
    }
    return $holiday;
  }
  /**
   * 
   * @param  string $format
   * @param  string $name
   * @return VaryingAnnualHoliday
   * @throws CalendarEventException
   */
  public function insertVaryingAnnualHoliday(string $format, string $name): VaryingAnnualHoliday {
    $holiday = Events::varyingAnnualHoliday($format, $name);
    $inserted = $this->insertEvent($holiday);
    if (!$inserted) {
      throw new CalendarEventException('Varying Annual Holiday could not be inserted to the collection');
    }
    return $holiday;
  }
  /**
   * 
   * @param  string $format
   * @param  string $name
   * @return VaryingAnnualHoliday
   * @throws CalendarEventException
   */
  public function insertNote( $date, string $name, string $description = null): Note {
    $note = Events::note($date, $name,$description);
    $inserted = $this->insertEvent($note);
    if (!$inserted) {
      throw new CalendarEventException('Note could not be inserted to the collection');
    }
    return $note;
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
   * @throws CalendarEventException
   */
  public function insertBirthday(int $month, int $day, $person, int $yearOfBirth = null): BirthDay {
    $birthDay = new BirthDay($month, $day, $person, $yearOfBirth);
    $inserted = $this->insertEvent($birthDay);
    if (!$inserted) {
      throw new CalendarEventException('Birthday could not be inserted to the collection');
    }
    return $birthDay;
  }

}
