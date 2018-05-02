<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\DateRange;
use Sphp\DateTime\DateInterface;

/**
 * Implements an in range date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InRange implements DateConstraint {

  /**
   * @var DateRange 
   */
  private $dateRange;

  /**
   * Constructor
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $start start of date range (null for no starting point)
   * @param  DateInterface|\DateTimeInteface|string|int|null $stop end of date range (null for no ending point)
   */
  public function __construct($start = null, $stop = null) {
    $this->dateRange = new DateRange($start, $stop);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateRange);
  }

  public function getRange(): DateRange {
    return $this->dateRange;
  }

  public function isValidDate($date): bool {
    return $this->dateRange->isInRange($date);
  }

}
