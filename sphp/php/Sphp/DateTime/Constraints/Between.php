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

use Sphp\DateTime\Date;

/**
 * Implements a between two dates date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Between implements DateConstraint {

  private Date $start;
  private Date $end;

  /**
   * Constructor
   * 
   * @param Date $start start of date range (null for no starting point)
   * @param Date $stop end of date range (null for no ending point)
   */
  public function __construct(Date $start, Date $stop) {
    $this->start = $start;
    $this->end = $stop;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->end);
  }

  /**
   * Clones the instance
   */
  public function __clone() {
    $this->start = clone $this->start;
    $this->end = clone $this->end;
  }

  public function isValid(Date $date): bool {
    return $this->start->compareDateTo($date) <= 0 && $this->end->compareDateTo($date) >= 0;
  }

}
