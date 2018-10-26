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

/**
 * Implements a date object containing corresponding diary logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DiaryDate extends Date implements Iterator, DiaryDateInterface {

  use DiaryTrait;

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
    parent::__construct($date);
    $this->logs = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logs);
    parent::__destruct();
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

  public function logExists(LogInterface $log): bool {
    $contains = false;
    foreach ($this->logs as $n) {
      $contains = $log == $n;
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

  /**
   * Filters log of this collection using a callback function
   * 
   * @param  callable|string $filter the callback function to use
   * @return LogContainer filtered logs
   */
  public function filterLogs($filter): LogContainer {
    $logs = array_filter($this->logs, $filter);
    return new static($this, $logs);
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
