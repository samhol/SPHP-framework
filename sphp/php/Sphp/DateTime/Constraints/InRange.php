<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Periods;

/**
 * Implements an in range date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InRange implements DateConstraint {

  /**
   * @var Period 
   */
  private $dateRange;

  /**
   * Constructor
   * 
   * @param  mixed $start start of date range (null for no starting point)
   * @param  mixed $stop end of date range (null for no ending point)
   */
  public function __construct($start = null, $stop = null) {
    $this->dateRange = Periods::days($start, $stop);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateRange);
  }

  public function isValid($date): bool {
    return $this->dateRange->isInPeriod($date);
  }

}
