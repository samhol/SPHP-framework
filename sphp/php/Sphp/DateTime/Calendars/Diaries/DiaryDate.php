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
use Iterator;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holiday;
use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;

/**
 * Implements a date object for diary logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DiaryDate extends Date implements Iterator, DiaryDateInterface {

  /**
   * @var LogInterface[] 
   */
  private $logs = [];

  /**
   * Constructor
   * 
   * @param mixed $date
   */
  public function __construct($date) {
    parent::__construct($date);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logs);
  }

  /**
   * Checks for a national holiday
   * 
   * @return bool true if national holiday, false otherwise
   */
  public function isNationalHoliday(): bool {
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
  public function isFlagDay(): bool {
    $isNational = false;
    foreach ($this->getHolidays() as $note) {
      if ($note->isFlagDay()) {
        $isNational = true;
        break;
      }
    }
    return $isNational;
  }

  public function logExists(LogInterface $note): bool {
    $contains = false;
    foreach ($this->logs as $n) {
      $contains = $note == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  public function insertLog(LogInterface $log): bool {
    if (!$log->dateMatchesWith($this)) {
      return false;
    } else {
      $this->logs[] = $log;
      return true;
    }
  }

  /**
   * Merges logs from another log container
   * 
   * @param  LogContainer $logs logs to merge
   * @return $this for a fluent interface
   */
  public function mergeLogs(LogContainer $logs) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
    return $this;
  }

  public function __toString(): string {
    $output = $this->format('l, ') . ":\n";
    //print_r($this->notes);
    foreach ($this as $log) {
      $output .= "  $log\n";
    }
    return $output;
  }

  public function onLogInsert(LogInterface $log) {
    $this->insertLog($log);
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array {
    return array_filter($this->logs, function ($item) {
      return $item instanceof BirthDay;
    });
  }

  /**
   * Returns all holidays stored
   * 
   * @return LogInterface[] all holiday notes stored
   */
  public function filterLogs($filter): array {
    return array_filter($this->logs, $filter);
  }

  /**
   * Returns all holidays stored
   * 
   * @return HolidayInterface[] all holiday notes stored
   */
  public function getHolidays(): array {
    return array_filter($this->logs, function ($item) {
      return $item instanceof HolidayInterface;
    });
  }

  public function toArray(): array {
    return $this->logs;
  }

  /**
   * Checks if the event collection is empty
   * 
   * @return bool true if the event collection is empty, false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->logs);
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->logs);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->logs);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key() {
    return key($this->logs);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->logs);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->logs);
  }

}
