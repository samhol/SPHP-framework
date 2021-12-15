<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Constraints;

use Sphp\DateTime\Date;

/**
 * Class Exactly
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Exactly implements DateConstraint {

  /**
   * @var Date 
   */
  private Date $expected;

  /**
   * Constructor
   * 
   * @param Date $expected expected date
   */
  public function __construct(Date $expected) {
    $this->expected = $expected;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->expected);
  }

  public function isValid(Date $date): bool {
    return $this->expected->dateEqualsTo($date);
  }

}
