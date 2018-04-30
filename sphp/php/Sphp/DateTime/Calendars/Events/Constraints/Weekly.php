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
 * Description of WeeklyRepetition
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Weekly implements Constraint {

  /**
   * @var int
   */
  private $weekdays;

  /**
   * Constructor
   * 
   * @param int ...$weekdays
   */
  public function __construct(int... $weekday) {
    /* if (0 > $weekday || $weekday > 7) {
      throw new Exceptions\CalendarEventException("Parameter weekday must be between 1-7 ($weekday given)");
      } */
    $this->weekdays = $weekday;
  }

  public function isValidDate($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new Date();
    }
    return in_array($date->getWeekDay(), $this->weekdays, true);
  }

}
