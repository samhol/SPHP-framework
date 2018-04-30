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
use Sphp\DateTime\Calendars\Events\Constraints\Constraint;
/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
 class Holiday extends AbstractNote implements HolidayInterface {

  /**
   * @var bool 
   */
  private $national = false;

  /**
   * @var bool 
   */
  private $flagDay = false;




  public function __toString(): string {
    $output = $this->getName();
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

  public function eventAsString(): string {
    $output = $this->getName();
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
   * @return $this for a fluent interface
   */
  public function setNationalHoliday(bool $national = true) {
    $this->national = $national;
    return $this;
  }

}
