<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use DatePeriod;
use Sphp\DateTime\Period;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements a between two dates date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InPeriod implements DateConstraint {

  /**
   * @var Period
   */
  private $period;

  /**
   * Constructor
   * 
   * @param  string|DatePeriod|Period $period
   * @throws InvalidArgumentException if invalid period parameter was given 
   */
  public function __construct($period) {
    if (is_string($period)) {
      $this->period = Period::fromISO($period);
    } else if ($period instanceof DatePeriod) {
      $this->period = new Period($period);
    } else if ($period instanceof Period) {
      $this->period = $period;
    } else {
      throw new InvalidArgumentException('Invalid period parameter was given');
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->period);
  }

  public function isValid($date): bool {
    return $this->period->containsDate($date);
  }

}
