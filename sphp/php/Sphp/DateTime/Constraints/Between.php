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
 * Implements a between two dates date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Between implements DateConstraint {

  /**
   * @var Date
   */
  private $start;

  /**
   * @var Date
   */
  private $end;

  /**
   * Constructor
   * 
   * @param  mixed $start start of date range (null for no starting point)
   * @param  mixed $stop end of date range (null for no ending point)
   */
  public function __construct($start = null, $stop = null) {
    $this->start = Date::from($start);
    $this->end = Date::from($stop);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->start, $this->end);
  }

  public function isValid($date): bool {
    return $this->start->compareTo($date) <= 0 && $this->end->compareTo($date) >= 0;
  }

}
