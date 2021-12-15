<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Events;

use IteratorAggregate;
use Sphp\DateTime\{
  ImmutableDateTime,
  Duration,
  Interval,
  Period,
  DateTime,
  Date
};
use Sphp\Apps\Calendars\Diaries\Diary;
use Sphp\Apps\Calendars\Diaries\DiaryDateInterface;
use Sphp\Apps\Calendars\Diaries\DiaryDate;

/**
 * Description of RepeatingTask
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PeriodicEvent extends AbstractEvent implements Diary, IteratorAggregate {

  /**
   * @var Period 
   */
  private Period $period;

  /**
   * @var Duration 
   */
  private Duration $duration;

  /**
   * Constructor
   * 
   * @param string $event
   * @param Period $period
   * @param Duration $duration
   */
  public function __construct(string $event, Period $period, Duration $duration) {
    parent::__construct($event);
    $this->duration = $duration;
    $this->period = $period;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    parent::__destruct();
    unset($this->duration, $this->period);
  }

  public function getPeriod(): Period {
    return $this->period;
  }

  /**
   * 
   * @return SingleTask[]
   */
  public function toArray(): array {
    $tasks = [];
    foreach ($this->period as $dateTime) {
      $imDate = ImmutableDateTime::from($dateTime);
      //echo  $imDate->add($this->duration)->format('H:i:s')."\n";
      $task = new SingleTask($imDate, $imDate->add($this->duration));
      $task->setDescription($this->getDescription());
      $tasks[] = $task;
    }
    return $tasks;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->toArray());
  }

  /**
   * Creates a new event instance from ISO strings
   *
   * @param  string $name
   * @param  string $period
   * @param  string $duration
   * @return PeriodicEvent
   */
  public static function fromISO(string $name, string $period, string $duration): PeriodicEvent {
    return new static($name, Period::fromISO($period), new Interval($duration));
  }

  public function dateMatchesWith(Date $date): bool {
    return $this->getStart()->compareDateTo($date) <= 0 &&
            $this->getEnd()->compareDateTo($date) >= 0;
  }

  public function getDuration(): Duration {
    return $this->duration;
  }

  public function getStart(): DateTime {
    return $this->getPeriod()->getStartDate();
  }

  public function getEnd(): DateTime {
    return $this->getPeriod()->getEndDate()->add($this->getDuration());
  }

  public function getDate($date): DiaryDateInterface {
    $diaryDate = new DiaryDate($date);
    foreach ($this->getPeriod() as $start) {
      $end = $start->add($this->getDuration());
      if ($start->compareDateTo($date) <= 0 && $end->compareDateTo($date) >= 0) {
        $evt = new SingleEvent($this->getName(), $start, $this->getDuration());
        $evt->setData($this->getData())->setDescription($this->getDescription());
        $diaryDate->insertLog($evt);
      }
    }
  }

}
