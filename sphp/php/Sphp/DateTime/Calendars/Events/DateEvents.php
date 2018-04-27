<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

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
class DateEvents extends AbstractEventCollection {

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
    foreach ($this as $note) {
      if ($note->flagDay()) {
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

  /**
   * 
   * @param  string $person
   * @return BirthDay inserted instance
   */
  public function insertBirthday($person, int $yearOfBirth = null): BirthDay {
    $month = $this->date->getMonth();
    $day = $this->date->getMonthDay();
    $birthDay = new BirthDay($month, $day, $person, $yearOfBirth);
    $inserted = $this->insertEvent($birthDay);
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
    $inserted = $this->insertEvent($birthDay);
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
  public function insertAnnualHoliday(string $desc): AnnualHoliday {
    $month = $this->date->getMonth();
    $day = $this->date->getMonthDay();
    $birthDay = new AnnualHoliday($month, $day, $desc);
    $inserted = $this->insertEvent($birthDay);
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
