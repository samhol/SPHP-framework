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
 * Description of WeeklyHoliday
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WeeklyNote extends AbstractNote {

  /**
   * @var int
   */
  private $weekdays;

  /**
   * Constructor
   * 
   * @param int[] $weekdays
   * @param string $name
   * @param string $description
   */
  public function __construct(array $weekdays, string $name, string $description = null) {
    parent::__construct($name, $description);
    /* if (0 > $weekday || $weekday > 7) {
      throw new Exceptions\CalendarEventException("Parameter weekday must be between 1-7 ($weekday given)");
      } */
    $this->weekdays = $weekdays;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return in_array($date->getWeekDay(), $this->weekdays, true);
  }

}
