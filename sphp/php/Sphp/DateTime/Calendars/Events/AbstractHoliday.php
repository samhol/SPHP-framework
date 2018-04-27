<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\DateInterface;

/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractHoliday implements HolidayInterface {

  /**
   * @var bool 
   */
  private $national = false;

  /**
   * @var bool 
   */
  private $flagDay = false;

  /**
   * @var string 
   */
  private $name;

  /**
   * Constructor
   * 
   * @param DateInterface $date 
   * @param string $name
   */
  public function __construct(string $name) {
    $this->name = $name;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->name);
  }

  public function __toString(): string {
    return $this->noteAsString();
  }

  public function eventAsString(): string {
    $output = "$this->name";
    $attrs = [];
    if ($this->isNationalHoliday()) {
      $attrs[] = "national holiday";
    }
    if ($this->isFlagDay()) {
      $attrs[] = "flagday";
    }
    if (!empty($attrs)) {
      $output .= ': ' . implode(', ', $attrs);
    }
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
   * 
   * @param type $name
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * 
   * @param  bool $flagDay
   * @return $this for a fluent interface
   */
  public function setFlagDay(bool $flagDay = true) {
    $this->flagDay = $flagDay;
    return $this;
  }

  /**
   * 
   * @return bool
   */
  public function isFlagDay(): bool {
    return $this->flagDay;
  }

  /**
   * 
   * @return bool
   */
  public function isNationalHoliday(): bool {
    return $this->national;
  }

  /**
   * 
   * @param  bool $national
   * @return $this
   */
  public function setNationalHoliday(bool $national = true) {
    $this->national = $national;
    return $this;
  }

}
