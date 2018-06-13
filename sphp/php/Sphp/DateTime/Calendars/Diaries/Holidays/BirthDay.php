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
   * @param int $month the month of birth
   * @param int $day the day of birth
   * @param string|null $name name of the person
   * @param int|null $yearOfBirth the year of birth (null for unknown)
   */
  public function __construct(int $month, int $day, string $name, int $yearOfBirth = null) {
    $constraints = new Constraints();
    $constraints->dateIs(new Annual($month, $day));
    if ($yearOfBirth !== null) {
      $constraints->dateIsNot(new Before("$yearOfBirth-$month-$day"));
    }
    parent::__construct($constraints, $name);
    $this->year = $yearOfBirth;
    $this->month = $month;
    $this->day = $day;
  }

  /**
   * Sets the year of birth
   * 
   * @param  int $year the year of birth
   * @return $this for a fluent interface
   */
  public function setBirthYear(int $year = null) {
    $this->year = $year;
    return $this;
  }

  public function toString(int $currentYear = null): string {
    $output = "Birthday of {$this->getName()}";
    if (is_int($currentYear) && is_int($this->year)) {
      $age = $currentYear - $this->year;
      if ($age === 0) {
        $output .= " (was born this day)";
      }
      $output .= " (was born $age years ago)";
    }
    //$output .= $this->getDate()->format('l, Y-m-d');
    if ($this->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($this->isFlagDay()) {
      $output .= " (flagday)";
    }
    return $output;
  }

}
