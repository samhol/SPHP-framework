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
 * Defines DiaryTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
trait DiaryTrait {

  public function logExists(LogInterface $log): bool {
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
   * Returns all holidays stored
   * 
   * @return LogInterface all holiday notes stored
   */
  abstract public function filterLogs($filter): LogContainer;

  /**
   * Returns all logs of given PHP type stored
   * 
   * @param  string $type
   * @return LogInterface[] all logs of given PHP object type stored
   */
  public function getByType(string $type): LogContainer {
    return $this->filterLogs(function ($item) use ($type) {
              return $item instanceof $type;
            });
  }

  /**
   * Returns all holidays stored
   * 
   * @return LogContainer all holiday logs stored
   */
  public function getHolidays(): LogContainer {
    return $this->getByType(HolidayInterface::class);
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return LogContainer all birthday logs stored
   */
  public function getBirthdays(): LogContainer {
    return $this->getByType(BirthDay::class);
  }

}
