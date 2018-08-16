<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Constraints;

use Sphp\DateTime\DateInterface;
use Sphp\DateTime\DateWrapper;

/**
 * Implements an annual date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Annual implements DateConstraint {

  /**
   * @var int 
   */
  private $day, $month;

  /**
   * Constructor
   * 
   * @param int $month
   * @param int $day
   * @throws Exceptions\CalendarEventException if constructor fails
   */
  public function __construct(int $month, int $day) {
    if (0 > $month || $month > 12) {
      throw new Exceptions\CalendarEventException("Parameter month must be between 1-12 ($month given)");
    } if (0 > $day || $day > 31) {
      throw new Exceptions\CalendarEventException("Parameter day must be between 1-31 ($day given)");
    }
    $this->day = $day;
    $this->month = $month;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->day, $this->month);
  }

  public function getMonthDay(): int {
    return $this->day;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function isValidDate($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new DateWrapper($date);
    }
    return $this->month === $date->getMonth() && $this->day === $date->getMonthDay();
  }

}
