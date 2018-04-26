<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Notes;

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
   * @param DateInterface $date 
   * @param string $name
   */
  public function __construct(int $weekday, string $name, DateInterface $starts = null) {
    parent::__construct($name);
    $this->weekday = $weekday;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    return $date->getWeekDay() === $this->weekday;
  }

  public function getWeekDay(): int {
    return $this->weekday;
  }

}
