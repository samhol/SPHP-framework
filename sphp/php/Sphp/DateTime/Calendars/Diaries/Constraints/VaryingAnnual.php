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
use Sphp\DateTime\Date;

/**
 * Description of Varying
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VaryingAnnual implements DateConstraint {

  /**
   * @var string 
   */
  private $format;

  /**
   * Constructor
   * 
   * @param string $format datetime format 
   * @param string $name
   */
  public function __construct(string $format) {
    $this->format = $format;
  }

  public function isValidDate($date): bool {
    if (!$date instanceof DateInterface) {
      $date = new Date($date);
    }
    $year = $date->getYear();
    $check = Date::from(sprintf($this->format, $year));
    return $check->matchesWith($date);
  }

}
