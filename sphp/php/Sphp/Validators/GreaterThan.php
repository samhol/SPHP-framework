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
 * Validates data against certain minimum value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class GreaterThan extends AbstractLimitValidator {

  private float $min;

  /**
   * Constructs a new validator
   * 
   * @param float $min the minimum value
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(float $min, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->min = $min;
    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setTemplate(static::EXCLUSIVE_ERROR, 'Not larger than :min');
    $this->getMessages()->setTemplate(static::INCLUSIVE_ERROR, 'Not larger than or equal to :min');
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value) {
        $this->setError(static::INCLUSIVE_ERROR);
        return false;
      }
    } else if ($this->min >= $value) {
      $this->setError(static::EXCLUSIVE_ERROR);
      return false;
    }
    return true;
  }

}
