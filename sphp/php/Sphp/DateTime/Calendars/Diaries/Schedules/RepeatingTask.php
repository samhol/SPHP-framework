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
use Sphp\DateTime\Constraints\DateConstraint;
use Sphp\DateTime\Time;

/**
 * Description of RepeatingTask
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class RepeatingTask extends AbstractLog implements Task {

  /**
   * @var Time 
   */
  private $start;

  /**
   * @var Time 
   */
  private $end;

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
   * @param DateConstraint $constraint
   */
  public function __construct(Time $start, Time $end, DateConstraint $constraint = null) {
    parent::__construct($constraint);
    $this->start = $start;
    $this->end = $end;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->end, $this->data);
  }

  public function __toString(): string {
    $output = "{$this->getDescription()}: $this->start - $this->end";
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

}
