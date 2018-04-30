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

/**
 * Collection for calendar date notes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateEvents extends AbstractEventCollection implements CalendarEventListener {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param Date $date
   */
  public function __construct(Date $date) {
    $this->date = $date;
    parent::__construct();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date);
    parent::__destruct();
  }

  /**
   * Checks for a national holiday
   * 
   * @return bool true if national holiday, false otherwise
   */
  public function nationalHoliday(): bool {
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
   * Checks for a flag day
   * 
   * @return bool true if flag day, false otherwise
   */
  public function flagDay(): bool {
    $isNational = false;
    foreach ($this->getHolidays() as $note) {
      if ($note->isFlagDay()) {
        $isNational = true;
        break;
      }
    }
    return $isNational;
  }

  /**
   * Returns the plain date object
   * 
   * @return Date the plain date object
   */
  public function getDate(): Date {
    return $this->date;
  }

  public function insertEvent(Event $note): bool {
    if (!$note->dateMatchesWith($this->date)) {
      return false;
    } else {
      return parent::insertEvent($note);
    }
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this as $note) {
      if ($note instanceof Event) {
        $output .= "  {$note->eventAsString()}\n";
      }
    }
    return $output;
  }

  public function onEventInsert(Event $event) {
    $this->insertEvent($event);
  }

}
