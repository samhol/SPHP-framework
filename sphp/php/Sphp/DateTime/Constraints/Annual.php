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
 * Implements an annual date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Annual implements DateConstraint {

  /**
   * @var string 
   */
  private string $param;

  /**
   * Constructor
   * 
   * @param int $month
   * @param int $day
   */
  public function __construct(int $month, int $day) {
    $this->param = "$month-$day";
  }

  public function isValid(Date $date): bool { 
    return $this->param === $date->format('n-j');
  }

}
