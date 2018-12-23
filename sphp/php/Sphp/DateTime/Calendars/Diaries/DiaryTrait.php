<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;

/**
 * Defines a trait for some basic diary functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait DiaryTrait {

  /**
   * Checks whether given log instance exists
   * 
   * @param  LogInterface $log the log instance to search
   * @return bool true if given log instance exists, false otherwise
   */
  public function logExists(CalendarEntry $log): bool {
    $contains = false;
    foreach ($this as $n) {
      $contains = $log == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  /**
   * Filters log of this collection using a callback function
   * 
   * @param  callable|string $filter the callback function to use
   * @return LogContainer filtered logs
   */
  abstract public function filterLogs($filter): EntryContainer;

  /**
   * Returns all logs of given PHP type stored
   * 
   * @param  string $type
   * @return LogContainer all logs of given PHP object type stored
   */
  public function getByType(string $type): EntryContainer {
    return $this->filterLogs(function ($item) use ($type) {
              return $item instanceof $type;
            });
  }

  /**
   * Returns all holidays stored
   * 
   * @return LogContainer all holiday logs stored
   */
  public function getHolidays(): EntryContainer {
    return $this->getByType(HolidayInterface::class);
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return LogContainer all birthday logs stored
   */
  public function getBirthdays(): EntryContainer {
    return $this->getByType(BirthDay::class);
  }

}
