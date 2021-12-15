<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates data against certain limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractLimitValidator extends AbstractValidator {

  /**
   * `ID` for error message describing values not matching an inclusive limit
   */
  const INCLUSIVE_ERROR = 'INCLUSIVE_ERROR';

  /**
   * `ID` for error message describing values not matching an exclusive limit
   */
  const EXCLUSIVE_ERROR = 'EXCLUSIVE_ERROR';

  /**
   * Whether to do inclusive comparisons, allowing equivalence to max
   *
   * If false, then strict comparisons are done, and the value may equal
   * the min option 
   */
  private bool $inclusive;

  /**
   * Constructor
   * 
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(bool $inclusive) {
    parent::__construct();
    $this->setInclusive($inclusive);
  }

  /**
   * Checks whether the the limit is set as inclusive or not
   * 
   * @return bool true for inclusive limit and false for not
   */
  public function isInclusive(): bool {
    return $this->inclusive;
  }

  /**
   * Sets whether the the limit is inclusive or not
   * 
   * @param  bool $inclusive true for inclusive limit and false for exclusive
   * @return $this for a fluent interface
   */
  public function setInclusive(bool $inclusive) {
    $this->inclusive = $inclusive;
    return $this;
  }

}
