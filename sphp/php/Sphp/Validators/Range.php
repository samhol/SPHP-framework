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
 * Validates data against certain numeric range
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Range extends AbstractLimitValidator {

  private float $min;
  private float $max;

  /**
   * Constructs a new validator
   * 
   * @param float $min the minimum value
   * @param float $max the maximum value
   * @param boolean $inclusive
   */
  public function __construct(float $min, float $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->min = $min;
    $this->max = $max;
    $this->getMessages()->setParameter(':min', $this->min);
    $this->getMessages()->setParameter(':max', $this->max);
    $this->getMessages()->setTemplate(static::EXCLUSIVE_ERROR, 'Not in range (:min, :max)');
    $this->getMessages()->setTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (:min, :max)');
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value || $this->max < $value) {
        $this->setError(static::INCLUSIVE_ERROR);
        return false;
      }
    } else {
      if ($this->min >= $value || $this->max <= $value) {
        $this->setError(static::EXCLUSIVE_ERROR);
        return false;
      }
    }
    return true;
  }

}
