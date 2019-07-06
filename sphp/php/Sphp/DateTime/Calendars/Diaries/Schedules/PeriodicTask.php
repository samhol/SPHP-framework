<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Schedules;

use IteratorAggregate;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\Duration;
use Sphp\DateTime\Interval;
use Sphp\DateTime\Period;
use Sphp\DateTime\Constraints\Constraints;

/**
 * Description of RepeatingTask
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PeriodicTask implements Task, IteratorAggregate {

  /**
   * @var Constraint 
   */
  private $constraint;

  /**
   * @var Period 
   */
  private $period;

  /**
   * @var Duration 
   */
  private $duration;

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
   * @param Period $period
   * @param Interval $duration
   */
  public function __construct(Period $period, Interval $duration) {
    $this->duration = $duration;
    $this->period = $period;
    $this->constraint = new Constraints();
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

  public function dateConditions(): Constraints {
    return $this->constraint;
  }

  /**
   * Returns the description text
   * 
   * @return string the description text
   */
  public function getDescription(): string {
    return "$this->description";
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
   * @return $this for a fluent interface
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
      $tasks[] = $task;
    }
    return $tasks;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->toArray());
  }

  /**
   * Creates a new task instance
   * 
   * @param  mixed $period
   * @param  mixed $duration
   * @return RepeatingTask a new task instance
   */
  public static function from($period, $duration): PeriodicTask {
    if (is_string($period)) {
      $period = Period::fromISO($period);
    } if (is_string($duration)) {
      $duration = new Interval($duration);
    }
    return new static($period, $duration);
  }

  public function dateMatchesWith($date): bool {
    $valid = true;
    foreach ($this->period as $start) {
      $imDate = DateTime::from($start);
      //echo  $imDate->add($this->duration)->format('H:i:s')."\n";
      //$task = new SingleTask($imDate, $imDate->add($this->duration));
      $valid = (new \Sphp\DateTime\Constraints\Between($imDate, $imDate->add($this->duration)))->isValid($date);
      //var_dump($valid);
      if (!$valid) {
        break;
      }
      //$task->setDescription($this->getDescription());
      //$tasks[] = $task;
      return $valid;
    }
    return $this->period->containsDate($date);
    
  }

}
