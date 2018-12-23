<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

/**
 * Implements a Calendar Date Event dispatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LogDispatcher extends MutableDiary {

  private $listeners = [];

  public function addListener($l) {
    $this->listeners[] = $l;
  }

  public function triggerInsert(CalendarEntry $log) {
    foreach ($this->listeners as $listener) {
      if ($listener instanceof CalendarEventListener) {
        $listener->onEventInsert($log);
      } else {
        $listener($log);
      }
    }
  }

  public function insertLog(CalendarEntry $log): bool {
    $inserted = parent::insertLog($log);
    if ($inserted) {
      $this->triggerInsert($log);
    }
    return $inserted;
  }

}
