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
 * Implements a varying annual date constraint
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class VaryingAnnual implements DateConstraint {

  /**
   * @var string 
   */
  private $format;

  /**
   * Constructor
   * 
   * @param string $format datetime format 
   */
  public function __construct(string $format) {
    $this->format = $format;
  }

  public function isValid($date): bool {
    $year = Date::from($date)->getYear();
    $check = Date::from(sprintf($this->format, $year));
    return $check->dateEqualsTo($date);
  }

}
