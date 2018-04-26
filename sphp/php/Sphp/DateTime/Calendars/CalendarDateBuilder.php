<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\Calendars\Notes\NoteCollection;
use Sphp\DateTime\Date;
/**
 * Description of CalendarDateBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CalendarDateBuilder {

  /**
   * @var CalendarDate[]
   */
  private $days;

  /**
   * @var NoteCollection 
   */
  private $notes;

  /**
   * Constructor
   */
  public function __construct(NoteCollection $notes = null) {
    if ($notes === null) {
      $notes = new NoteCollection();
    }
    $this->notes = $notes;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->notes);
  }

  /**
   * Clone method
   */
  public function __clone() {
    $this->notes = clone $this->notes;
  }

  public function getNotes(): NoteCollection {
    return $this->notes;
  }

  public function setNotes(NoteCollection $notes) {
    $this->notes = $notes;
    return $this;
  }

  /**
   * 
   * @param  CalendarDate $date
   * @return CalendarDate
   */
  public function mergeDate(CalendarDate $date): CalendarDate {
    //$key = $this->parseKey($date);
    if (!$this->contains($date)) {
      return $this->setDate($date);
    } else {
      return $this->get($date)->mergeNotes($date);
    }
  }

  public function createCalendarDate($date, $data = null): CalendarDate {
    $d = Date::from($date);
    $calendarDate = new CalendarDate($date, $data);
    foreach ($this->getNotes()->getNotesForDate($d) as $note) {
      $calendarDate->addNote($note);
    }
    return $calendarDate;
  }

}
