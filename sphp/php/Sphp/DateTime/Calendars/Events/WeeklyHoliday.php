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
class WeeklyHoliday extends AbstractHoliday implements WeeklyNote {

  /**
   * @var int
   */
  private $weekday;

  /**
   * Constructor
   * 
   * @param int $weekday
   * @param string $name
   * @param DateInterface $starts
   */
  public function __construct(int $weekday, string $name, DateInterface $starts = null) {
    parent::__construct($name);
    if (0 > $weekday || $weekday > 7) {
      throw new Exceptions\NoteException("Parameter weekday must be between 1-7 ($weekday given)");
    }
    $this->weekday = $weekday;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return $date->getWeekDay() === $this->weekday;
  }

  public function getWeekDay(): int {
    return $this->weekday;
  }

}
