<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;

use Sphp\DateTime\Date;
use Iterator;
use Sphp\DateTime\ImmutableDate;
use Sphp\Stdlib\Arrays;

/**
 * Implements an abstract calendar event collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MutableDiary implements Diary, Iterator, EntryContainer {

  /**
   * @var LogInterface[] 
   */
  private $logs = [];

  /**
   * Constructor
   */
  public function __construct(array $logs = []) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->logs);
  }

  public function __clone() {
    $this->logs = Arrays::copy($this->logs);
  }

  /**
   * Checks whether given log instance exists
   * 
   * @param  LogInterface $log the log instance to search
   * @return bool true if given log instance exists, false otherwise
   */
  public function logExists(CalendarEntry $log): bool {
    return in_array($log, $this->logs, true);
  }

  /**
   * Returns all logs of given PHP type stored
   * 
   * @param  string $type
   * @return LogContainer all logs of given PHP object type stored
   */
  public function getByType(string $type): array {
    return $this->filterLogs(function ($item) use ($type) {
              return $item instanceof $type;
            });
  }

  /**
   * 
   * @param  CalendarEntry $log
   * @return bool
   */
  public function insertLog(CalendarEntry $log): bool {
    $inserted = false;
    if (!$this->logExists($log)) {
      $this->logs[] = $log;
      $inserted = true;
    }
    return $inserted;
  }

  /**
   * 
   * @param  CalendarEntry[] $logs
   * @return $this
   */
  public function merge(iterable $logs) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
    return $this;
  }

  /**
   * Checks whether the date contains logs
   * 
   * @param  Date $date raw date data
   * @return bool true if the date contains logs and false otherwise
   */
  public function containsLogs(Date $date): bool {
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
  public function getDate(Date $date): DiaryDateInterface {
    $dailyLogs = new DiaryDate($date);
    foreach ($this as $log) {
      //var_dump(get_class($log));
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
  public function current(): mixed {
    return current($this->logs);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next(): void {
    next($this->logs);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key(): mixed {
    return key($this->logs);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind(): void {
    reset($this->logs);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->logs);
  }

  public function count(): int {
    return count($this->logs);
  }

}
