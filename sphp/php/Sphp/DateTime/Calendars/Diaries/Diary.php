<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Iterator;

/**
 * Implements an abstract calendar event collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Diary implements Iterator, MutableDiaryInterface {

  /**
   * @var LogInterface[] 
   */
  private $logs = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->logs = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logs);
  }

  public function insertLog(LogInterface $log): bool {
    $inserted = false;
    if (!$this->logExists($log)) {
      $this->logs[] = $log;
      $inserted = true;
    }
    return $inserted;
  }

  public function mergeLogs(LogContainer $logs) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
    return $this;
  }

  public function logExists(LogInterface $log): bool {
    $contains = false;
    /* foreach ($this->logs as $n) {
      $contains = $log == $n;
      if ($contains) {
      break;
      }
      } */
    return $contains;
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return bool 
   */
  public function containsLogs($date): bool {
    $contains = false;
    foreach ($this->logs as $log) {
      $contains = $log->dateMatchesWith($date);
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  /**
   * Returns an object containing logs for a single date
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return DiaryDateInterface object containing logs for given single date
   */
  public function getDate($date): DiaryDateInterface {
    $dailyLogs = new DiaryDay($date);
    foreach ($this->logs as $log) {
      $dailyLogs->insertLog($log);
    }
    return $dailyLogs;
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
   * @return Holiday[] all holiday notes stored
   */
  public function getHolidays(): array {
    return array_filter($this->logs, function ($item) {
      return $item instanceof HolidayInterface;
    });
  }

  /**
   * Returns all note type notes stored
   * 
   * @return BasicLog[] all note type notes stored
   */
  public function getNotes(): array {
    return array_filter($this->logs, function ($item) {
      return $item instanceof BasicLog;
    });
  }

  /**
   * Checks if the event collection is empty
   * 
   * @return bool true if the event collection is empty, false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->logs);
  }

  public function toArray(): array {
    return $this->logs;
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
