<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Schedules;

use Sphp\DateTime\DateTime;
use Sphp\DateTime\Date;

/**
 * Description of Task
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SingleTask implements Task {

  /**
   * @var DateTime 
   */
  private $start;

  /**
   * @var DateTime 
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
   * @param mixed $start
   * @param mixed $end
   */
  public function __construct($start, $end) {
    $this->start = DateTime::from($start);
    $this->end = DateTime::from($end);
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

  public function dateMatchesWith($date): bool {
    if (!$date instanceof Date) {
      $date = Date::from($date);
    }
    return $date->compareTo($this->start) >= 0 && $date->compareTo($this->end) <= 0;
  }

}
