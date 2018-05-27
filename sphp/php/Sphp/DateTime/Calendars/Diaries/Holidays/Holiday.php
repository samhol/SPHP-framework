<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\Calendars\Diaries\BasicLog;

/**
 * Implements a holiday note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Holiday extends BasicLog implements HolidayInterface {

  /**
   * @var bool 
   */
  private $national = false;

  /**
   * @var bool 
   */
  private $flagDay = false;

  public function __toString(): string {
    return $this->eventAsString();
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

  public function isFlagDay(): bool {
    return $this->flagDay;
  }

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
