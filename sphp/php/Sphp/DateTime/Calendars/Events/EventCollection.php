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

  public function getEventsForDate($date): array {
    $notes = [];
    $parsed = Date::from($date);
    foreach ($this as $note) {
      if ($note->dateMatchesWith($parsed)) {
        $notes[] = $note;
      }
    }
    return $notes;
  }

}
