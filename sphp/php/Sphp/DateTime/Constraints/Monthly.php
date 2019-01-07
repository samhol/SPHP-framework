<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;

/**
 * Implements a monthly date constraint
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
   */
  public function __construct(int $day) {
    $this->day = $day;
  }

  public function isValid($date): bool {
    return $this->day === Date::from($date)->getMonthDay();
  }

}
