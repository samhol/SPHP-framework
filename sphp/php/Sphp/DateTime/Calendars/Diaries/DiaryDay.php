<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\Date;

/**
 * Collection for Calendar Date Events
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DiaryDay extends AbstractDiary implements CalendarEventListener {

  /**
   * @var Date 
   */
  private $date;

  /**
   * Constructor
   * 
   * @param mixed $date
   */
  public function __construct($date) {
    $this->date = New Date($date);
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

  public function insertLog(LogInterface $log): bool {
    if (!$log->dateMatchesWith($this->date)) {
      return false;
    } else {
      return parent::insertLog($log);
    }
  }

  public function __toString(): string {
    $output = "$this->date:\n";
    //print_r($this->notes);
    foreach ($this as $log) {
      $output .= "  $log\n";
    }
    return $output;
  }

  public function onLogInsert(LogInterface $log) {
    $this->insertLog($log);
  }

}
