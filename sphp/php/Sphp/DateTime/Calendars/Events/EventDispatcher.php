<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

/**
 * Implements a Calendar Date Event dispatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EventDispatcher extends EventCollection {

  private $listeners = [];

  public function addListener($l) {
    $this->listeners[] = $l;
  }

  public function triggerInsert(Event $event) {
    foreach ($this->listeners as $listener) {
      if ($listener instanceof CalendarEventListener) {
        $listener->onEventInsert($event);
      } else {
        $listener($event);
      }
    }
  }

  public function insertEvent(Event $event): bool {
    $inserted = parent::insertEvent($event);
    if ($inserted) {
      $this->triggerInsert($event);
    }
    return $inserted;
  }

}
