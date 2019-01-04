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
use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\Schedules\Task;

/**
 * Implements a date object containing corresponding diary logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DiaryDate implements Iterator, DiaryDateInterface {

  use DiaryTrait;

  private $date;

  /**
   * @var LogInterface[] 
   */
  private $logs;

  /**
   * Constructor
   * 
   * @param mixed $date
   */
  public function __construct($date) {
    $this->date = Date::from($date);
//parent::__construct($date);
    $this->logs = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->logs);
//parent::__destruct();
  }

  public function getDate(): Date {
    return $this->date;
  }

  /**
   * Checks whether the date is a holiday
   * 
   * @return bool true if holiday, false otherwise
   */
  public function isHoliday(): bool {
    $isHoliday = false;
    foreach ($this as $holiday) {
      if ($holiday instanceof HolidayInterface) {
        $isHoliday = true;
        break;
      }
    }
    return $isHoliday;
  }

  /**
   * Checks whether the date is a national holiday
   * 
   * @return bool true if national holiday, false otherwise
   */
  public function isNationalHoliday(): bool {
    $isNational = false;
    foreach ($this as $holiday) {
      if ($holiday instanceof HolidayInterface && $holiday->isNationalHoliday()) {
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
    foreach ($this as $log) {
      if ($log instanceof HolidayInterface && $log->isFlagDay()) {
        $isNational = true;
        break;
      }
    }
    return $isNational;
  }

  /**
   * Checks whether the date contains tasks
   * 
   * @return bool true if the date contains tasks, false otherwise
   */
  public function containsTasks(): bool {
    $contains = false;
    foreach ($this as $task) {
      if ($task instanceof Task) {
        $contains = true;
        break;
      }
    }
    return $contains;
  }

  public function logExists(CalendarEntry $log): bool {
    $contains = false;
    foreach ($this->logs as $n) {
      $contains = $log == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  public function insertLog(CalendarEntry $log): bool {
    if (!$log->dateMatchesWith($this->getDate())) {
      return false;
    } else {
      $this->logs[] = $log;
      return true;
    }
  }

  public function merge(EntryContainer $logs) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
    return $this;
  }

  /**
   * Filters log of this collection using a callback function
   * 
   * @param  callable|string $filter the callback function to use
   * @return LogContainer filtered logs
   */
  public function filterLogs($filter): EntryContainer {
    $logs = array_filter($this->logs, $filter);
    $result = new static($this->getDate());
    foreach ($logs as $log) {
      $result->insertLog($log);
    }
    return $result;
  }

  public function __toString(): string {
    $output = $this->format('l, ') . ":\n";
//print_r($this->notes);
    foreach ($this as $log) {
      $output .= "  $log\n";
    }
    return $output;
  }

  public function onLogInsert(CalendarEntry $log) {
    $this->insertLog($log);
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

  public function count(): int {
    
  }

}
