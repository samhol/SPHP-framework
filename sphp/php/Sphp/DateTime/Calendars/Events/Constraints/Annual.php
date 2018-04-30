<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\DateInterface;

/**
 * Description of AnnualRule
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Annual implements Constraint {

  /**
   * @var int 
   */
  private $day, $month;

  /**
   * Constructor
   * 
   * @param  DateInterface $date 
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
    parent::__destruct();
  }

  public function getMonthDay(): int {
    return $this->day;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function isValid(DateInterface $date): bool {
    return $this->month === $date->getMonth() && $this->day === $date->getMonthDay();
  }

}
