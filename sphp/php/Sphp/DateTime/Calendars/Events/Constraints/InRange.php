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

/**
 * Description of InRange
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InRange implements Constraint {

  /**
   * @var DateRange 
   */
  private $dateRange;

  /**
   * Constructor
   * 
   * @param  DateInterface $date 
   * @throws Exceptions\CalendarEventException if constructor fails
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

  public function getDay(): DateRange {
    return $this->dateRange;
  }

  public function isValidDate($date): bool {
    return $this->dateRange->isInRange($date);
  }

}
