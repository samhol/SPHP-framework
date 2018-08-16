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
 * Implements a monthly constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Monthly implements DateConstraint {

  /**
   * @var int 
   */
  private $day;

  /**
   * Constructor
   * 
   * @param  int $day the day of the month
   * @throws Exceptions\CalendarEventException if constructor fails
   */
  public function __construct(int $day) {
    if (0 > $day || $day > 31) {
      throw new Exceptions\CalendarEventException("Parameter day must be between 1-31 ($day given)");
    }
    $this->day = $day;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->day);
  }

  public function getDay(): int {
    return $this->day;
  }

  public function isValidDate($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new DateWrapper($date);
    }
    return $this->day === $date->getMonthDay();
  }

}
