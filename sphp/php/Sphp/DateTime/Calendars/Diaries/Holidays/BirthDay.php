<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

use Sphp\DateTime\Calendars\Diaries\Constraints\Constraints;
use Sphp\DateTime\Calendars\Diaries\Constraints\Annual;
use Sphp\DateTime\Calendars\Diaries\Constraints\Before;

/**
 * Implements a BirthDay log object for a Diary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BirthDay extends Holiday {

  /**
   * @var int
   */
  private $year, $month, $day;

  /**
   * Constructor
   * 
   * @param int $year the year of birth
   * @param int $month the month of birth
   * @param int $day the day of birth
   * @param string|null $name name of the person
   */
  public function __construct(int $year, int $month, int $day, string $name) {
    $constraints = new Constraints();
    $constraints->dateIs(new Annual($month, $day));
    $constraints->dateIsNot(new Before("$year-$month-$day"));
    parent::__construct($constraints, $name);
    $this->year = $year;
    $this->month = $month;
    $this->day = $day;
  }

  public function getYear(): int {
    return $this->year;
  }

  public function getMonth(): int {
    return $this->month;
  }

  public function getDay(): int {
    return $this->day;
  }

}
