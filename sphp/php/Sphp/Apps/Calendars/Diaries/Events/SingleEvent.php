<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Events;

use Sphp\Apps\Calendars\Diaries\CalendarEntry;
use Sphp\DateTime\{
  DateTime,
  Duration,
  Date
};

/**
 * The BasicEvent class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SingleEvent extends AbstractEvent implements CalendarEntry {

  /**
   * @var DateTime
   */
  private DateTime $start;

  /**
   * @var Duration
   */
  private Duration $duration;

  /**
   * Constructs an instance
   * 
   * @param string $event
   * @param DateTime $start
   * @param Duration $duration
   */
  public function __construct(string $event, DateTime $start, Duration $duration) {
    parent::__construct($event);
    $this->start = $start;
    $this->duration = $duration;
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->start, $this->duration);
  }

  public function getStart(): DateTime {
    return $this->start;
  }

  public function getEnd(): DateTime {
    return $this->getStart()->add($this->getDuration());
  }

  public function isSingleDayEvent(): bool {
    return $this->getStart()->dateEqualsTo($this->getEnd());
  }

  public function getDuration(): Duration {
    return $this->duration;
  }

  public function dateMatchesWith(Date $date): bool {
    return $this->getStart()->compareDateTo($date) <= 0 && $this->getEnd()->compareDateTo($date) >= 0;
  }

  public static function fromDates(string $name, DateTime $start, DateTime $end): SingleEvent {
    $duration = $start->diff($end, true);
    return new self($name, $start, $duration);
  }

}
