<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries\Schedules;

use Sphp\DateTime\Date;
use Sphp\DateTime\Interval;

/**
 * Description of Task
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SingleTask implements CalendarEvent {

  /**
   * @var Date 
   */
  private $start;

  /**
   * @var Date 
   */
  private $end;

  /**
   * @var string
   */
  private $name, $description;

  /**
   * @var mixed
   */
  private $data;

  /**
   * Constructor
   * @param string $name
   * @param Date $start
   * @param Date $end
   */
  public function __construct(string $name, Date $start, Date $end) {
    $this->start = $start;
    $this->end = $end;
    $this->name = $name;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->end, $this->data);
  }

  public function __toString(): string {
    $output = "{$this->getName()}: $this->start - $this->end";
    return $output;
  }

  public function getDuration(): Interval {
    return $diff = $this->start->diff($this->end);
  }

  /**
   * 
   * @return  Date 
   */
  public function getStart(): Date {
    return $this->start;
  }

  public function isSingleDayEvent(): bool {
    return $this->start->dateEqualsTo($this->end);
  }

  /**
   * 
   * @return Date
   */
  public function getEnd(): Date {
    return $this->end;
  }

  /**
   * 
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * Sets the name of the log
   * 
   * @param  string $name the name of the log
   * @return $this for a fluent interface
   */
  public function setName(string $name) {
    $this->name = $name;
    return $this;
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

  public function dateMatchesWith(Date $date): bool {
    return $date->compareDateTo($this->start) >= 0 && $date->compareDateTo($this->end) <= 0;
  }

}
