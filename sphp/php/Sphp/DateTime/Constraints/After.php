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
 * Implements a constraint including all dates after the limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class After implements DateConstraint {

  /**
   * @var Date 
   */
  private Date $limit;

  /**
   * Constructor
   * 
   * @param Date $limit the lower limit date
   */
  public function __construct(Date $limit) {
    $this->limit = $limit;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->limit);
  }

  public function isValid(Date $date): bool {
    return $this->limit->compareDateTo($date) < 0;
  }

}
