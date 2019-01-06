<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Schedules;

use Sphp\DateTime\Calendars\Diaries\AbstractLog;
use Sphp\DateTime\Calendars\Diaries\Constraints\DateConstraint;
use Sphp\DateTime\Time;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\Duration;
use Sphp\DateTime\Interval;
use Sphp\DateTime\Period;

/**
 * Description of RepeatingTask
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RepeatingTask1 implements Task , \IteratorAggregate {

  /**
   * @var Period 
   */
  private $period;

  /**
   * @var Duration 
   */
  private $duration;

  /**
   * @var Period 
   */
  private $interval;

  /**
   * @var string 
   */
  private $description;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructor
   * 
   * @param Time $start
   * @param Time $end
   */
  public function __construct(Period $period,  $duration) {

    $this->duration = new Interval($duration);
    $this->period = $period;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->end, $this->data);
  }

  public function __toString(): string {
    $output = "{$this->getDescription()}: ";
    return $output;
  }

  public function compareTo(Task $task): int {
    
  }

  /**
   * Returns the description text
   * 
   * @return string the description text
   */
  public function getDescription(): string {
    return "$this->description";
  }

  public function getStart(): Time {
    return $this->start;
  }

  public function getEnd(): Time {
    return $this->end;
  }

  /**
   * Sets the description text
   * 
   * @param  string|null $description the description text
   * @return $this for a fluent interface
   */
  public function setDescription(string $description = null) {
    $this->description = $description;
    return $this;
  }

  /**
   * Sets the data
   * 
   * @return mixed
   */
  public function getData() {
    return $this->data;
  }

  /**
   * 
   * @param  mixed $data
   * @return $this
   */
  public function setData($data) {
    $this->data = $data;
    return $this;
  }
  
  /**
   * 
   * @return SingleTask[]
   */
  public function toArray(): array {
    $tasks = [];
    foreach ($this->period as $dateTime) {
      $imDate = DateTime::from($dateTime);
      //echo  $imDate->add($this->duration)->format('H:i:s')."\n";
     $task = new SingleTask($imDate, $imDate->add($this->duration));
     $task->setDescription($this->getDescription());
      $tasks[] =$task;
    }
    return $tasks;
  }
  
  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->toArray());
  }

  /**
   * Creates a new task instance
   * 
   * @param  mixed $start
   * @param  mixed $end
   * @param  DateConstraint $constraint
   * @return RepeatingTask a new task instance
   */
  public static function from($start, $end, DateConstraint $constraint = null): RepeatingTask {
    if (!$start instanceof Time) {
      $start = Time::from($start);
    } if (!$end instanceof Time) {
      $end = Time::from($end);
    }
    return new static($start, $end, $constraint);
  }

  public function dateMatchesWith($date): bool {
    $date = \Sphp\DateTime\Date::from($date);
    return $this->period->isInPeriod($date);
    
  }

}
