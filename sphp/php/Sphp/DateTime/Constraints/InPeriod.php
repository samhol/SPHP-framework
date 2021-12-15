<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use DatePeriod;
use Sphp\DateTime\Date;
use Sphp\DateTime\Period;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

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
  private Period $period;

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

  public function isValid(Date $date): bool {
    return $this->period->contains($date);
  }

}
