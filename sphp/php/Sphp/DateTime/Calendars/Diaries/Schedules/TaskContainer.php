<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Diaries\Schedules;

use Iterator;

/**
 * Description of TaskContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TaskContainer implements DiaryInterface, Iterator {

  use DiaryTrait;

  /**
   * @var Task[] 
   */
  private $logs = [];

  /**
   * Constructor
   */
  public function __construct() {

  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logs);
  }

  public function insert(Task $task): bool {
    $inserted = false;
    if (!$this->logExists($task)) {
      $this->logs[] = $task;
      $inserted = true;
    }
    return $inserted;
  }

  public function merge(TaskContainer $logs) {
    foreach ($logs as $log) {
      $this->insert($log);
    }
    return $this;
  }

  /**
   * Checks whether the date contains logs
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return bool true if the date contains logs and false otherwise
   */
  public function containsLogs($date): bool {
    $contains = false;
    foreach ($this as $log) {
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
   * @param  mixed $date raw date data
   * @return DiaryDateInterface object containing logs for given single date
   */
  public function getDate($date): array {
    $dailyLogs = new DiaryDate($date);
    foreach ($this as $log) {
      $dailyLogs->insertLog($log);
    }
    return $dailyLogs;
  }

  /**
   * Filters log of this collection using a callback function
   * 
   * @param  callable|string $filter the callback function to use
   * @return LogContainer filtered logs
   */
  public function filterLogs($filter): EntryContainer {
    $logs = array_filter($this->logs, $filter);
    return new static($logs);
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

  public function count(): int {
    return count($this->logs);
  }

}
