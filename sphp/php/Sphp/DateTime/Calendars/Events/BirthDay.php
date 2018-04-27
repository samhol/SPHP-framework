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
 * Implements a BirthDay note for a calendar
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BirthDay extends AnnualHoliday {

  private $year;

  /**
   * Constructor
   * 
   * @param int $month
   * @param int $day
   * @param string $name
   * @param int $yearOfBirth
   */
  public function __construct(int $month, int $day, string $name, int $yearOfBirth = null) {
    parent::__construct($month, $day, $name);
    $this->year = $yearOfBirth;
  }

  public function dateMatchesWith(DateInterface $date): bool {
    $match = parent::dateMatchesWith($date);
    return $match && ($this->year === null || $this->year <= $date->getYear());
  }

  public function setBirthYear(int $year = null) {
    $this->year = $year;
  }

  public function eventAsString(int $currentYear = null): string {
    $output = "Birthday of {$this->getName()}";
    if (is_int($currentYear) && is_int($this->year)) {
      $age = $currentYear - $this->year;
      $output .= "(Age $age)";
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
