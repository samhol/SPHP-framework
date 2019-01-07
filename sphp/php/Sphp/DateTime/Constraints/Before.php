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
 * Implements a constraint including all dates before the limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Before implements DateConstraint {

  /**
   * @var Date 
   */
  private $limit;

  /**
   * Constructor
   * 
   * @param mixed $limit the upper limit date
   */
  public function __construct($limit) {
    $this->limit = new Date($limit);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->limit);
  }

  public function isValid($date): bool {
    return $this->limit->compareTo($date) > 0;
  }

}
