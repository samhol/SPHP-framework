<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars;

/**
 * Description of BirthDay
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BirthDay extends Holiday {
  
  public function __toString(): string {
    $output = "Birthday of {$this->getName()}: ";
    $output .= $this->getDate()->format('l, Y-m-d');
    if ($this->isNationalHoliday()) {
      $output .= " (national holiday)";
    }
    if ($this->isFlagDay()) {
      $output .= " (flagday)";
    }
    return $output;
  }
}
