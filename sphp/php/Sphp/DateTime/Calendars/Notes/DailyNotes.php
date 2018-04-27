<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Notes;

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
class DailyNotes extends AbstractNoteCollection {

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
   */
  public function insertNote(Note $note): bool {
    if (!$note->dateMatchesWith($this->date)) {
      return false;
    } else {
      return parent::insertNote($note);
    }
  }

  public function dateMatch(Note $note): bool {
    return $note->dateMatchesWith($this->getDate());
  }

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   */
  public function insertBirthday($person, int $yearOfBirth = null): BirthDay {
    $month = $this->date->getMonth();
    $day = $this->date->getMonthDay();
    $birthDay = new BirthDay($month, $day, $person, $yearOfBirth);
    $inserted = $this->insertNote($birthDay);
    if (!$inserted) {
      throw new NoteException('Birthday could not be inserted to the collection');
    }
    return $birthDay;
  }

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   */
  public function insertAnnual($person, int $yearOfBirth = null): BirthDay {
    $month = $this->date->getMonth();
    $day = $this->date->getMonthDay();
    $birthDay = new BirthDay($month, $day, $person, $yearOfBirth);
    $inserted = $this->insertNote($birthDay);
    if (!$inserted) {
      throw new NoteException('Birthday could not be inserted to the collection');
    }
    return $birthDay;
  }

  /**
   * 
   * @param  string $desc
   * @return Holiday
   */
  public function insertAnnualHoliday(string $desc): Holiday {
    $month = $this->date->getMonth();
    $day = $this->date->getMonthDay();
    $birthDay = new AnnualHoliday($month, $day, $desc);
    $inserted = $this->insertNote($birthDay);
    if (!$inserted) {
      throw new NoteException('Annual holiday could not be inserted to the collection');
    }
    return $birthDay;
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this as $note) {
      // print_r($note);
      $output .= "  {$note->noteAsString()}\n";
    }
    return $output;
  }

}
