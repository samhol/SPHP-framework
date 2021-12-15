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
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Exceptions\{ 
  InvalidArgumentException
};

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
  private string $format;

  /**
   * Constructor
   * 
   * @param  string $format datetime format 
   * @throws InvalidArgumentException if the format is not valid date format using an year as a parameter
   */
  public function __construct(string $format) {
    $this->format = $format;
    try {
      ImmutableDate::from(sprintf($this->format, 2000));
    } catch (\Exception $ex) {
      throw new InvalidArgumentException('Format is not valid date format with an year as a parameter', $ex->getCode(), $ex);
    }
  }

  public function isValid(Date $date): bool {
    $year = $date->getYear();
    $check = ImmutableDate::from(sprintf($this->format, $year));
    $result = $check->dateEqualsTo($date);
    return $result;
  }

}
