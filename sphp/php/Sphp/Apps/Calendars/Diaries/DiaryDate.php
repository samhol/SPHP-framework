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
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Apps\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\Stdlib\Arrays;

/**
 * Implements a date object containing corresponding diary logs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DiaryDate implements IteratorAggregate, DiaryDateInterface {

  /**
   * @var Date
   */
  private Date $date;

  /**
   * @var LogInterface[] 
   */
  private array $logs;

  /**
   * Constructor
   * 
   * @param Date $date
   */
  public function __construct(Date $date) {
    $this->date = $date;
    $this->logs = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->date, $this->logs);
  }

  /**
   * Clones the object
   */
  public function __clone() {
    $this->date = clone $this->date;
    $this->logs = Arrays::copy($this->logs);
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
    $isFlagDay = false;
    foreach ($this as $log) {
      if ($log instanceof HolidayInterface && $log->isFlagDay()) {
        $isFlagDay = true;
        break;
      }
    }
    return $isFlagDay;
  }

  public function logExists(CalendarEntry $log): bool {
    return in_array($log, $this->logs, true);
  }

  public function insertLog(CalendarEntry $log): bool {
    $result = false;
    if ($log->dateMatchesWith($this->getDate()) && !$this->logExists($log)) {
      $this->logs[] = $log;
      $result = true;
    }
    return $result;
  }

  /**
   * 
   * @param  iterable $logs
   * @return $this
   */
  public function merge(iterable $logs) {
    foreach ($logs as $log) {
      $this->insertLog($log);
    }
    return $this;
  }

  /**
   * Filters log of this collection using a callback function
   * 
   * @param  callable|string $filter the callback function to use
   * @return CalendarEntry[] filtered logs
   */
  public function filterLogs($filter): array {
    $logs = array_filter($this->logs, $filter);
    $result = new static($this->getDate());
    foreach ($logs as $log) {
      $result->insertLog($log);
    }
    return $logs;
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

  public function count(): int {
    return count($this->logs);
  }

  /**
   * 
   * @return Traversable<CalendarEntry>
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->logs);
  }

}
