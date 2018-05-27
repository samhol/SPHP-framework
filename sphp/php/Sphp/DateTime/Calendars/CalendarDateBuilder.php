<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

use Sphp\DateTime\Calendars\Events\EventCollection;
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
   * @var EventCollection 
   */
  private $notes;

  /**
   * Constructor
   */
  public function __construct(EventCollection $notes = null) {
    if ($notes === null) {
      $notes = new EventCollection();
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

  public function getNotes(): BasicDiary {
    return $this->notes;
  }

  public function setNotes(EventCollection $notes) {
    $this->notes = $notes;
    return $this;
  }

  public function createCalendarDate($date, $data = null): CalendarDate {
    $d = Date::from($date);
    $calendarDate = new CalendarDate($date, $data);
    foreach ($this->getNotes()->getEventsForDate($d) as $note) {
      $calendarDate->addNote($note);
    }
    return $calendarDate;
  }

}
