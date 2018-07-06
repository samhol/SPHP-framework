<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Constraints;

use Sphp\DateTime\Period;
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
   * @var Period 
   */
  private $dateRange;

  /**
   * Constructor
   * 
   * @param  DateInterface|\DateTimeInteface|string|int|null $start start of date range (null for no starting point)
   * @param  DateInterface|\DateTimeInteface|string|int|null $stop end of date range (null for no ending point)
   */
  public function __construct($start = null, $stop = null) {
    $this->dateRange = new Period($start, $stop);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dateRange);
  }

  public function getRange(): Period {
    return $this->dateRange;
  }

  public function isValidDate($date): bool {
    return $this->dateRange->isInRange($date);
  }

}
