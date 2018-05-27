<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;

/**
 * Implements a basic calendar event collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicDiary extends AbstractDiary {

  /**
   * Returns calendar events concerning specific calendar date
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $date the calendar date
   * @return Event[] calendar events found
   */
  public function getEventsForDate($date): array {
    $notes = [];
    $parsed = Date::from($date);
    foreach ($this as $event) {
      if ($event->dateMatchesWith($parsed)) {
        $notes[] = $event;
      }
    }
    return $notes;
  }

}
