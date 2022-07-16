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
 * Validates data against certain maximum value
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SmallerThan extends AbstractLimitValidator {

  private float $max;

  /**
   * Constructor
   * 
   * @param float $max the maximum value
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(float $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->max = $max;
    $this->getMessages()->setParameter(':max', $this->max);
    $this->getMessages()->setTemplate(static::EXCLUSIVE_ERROR, 'Not smaller than :max');
    $this->getMessages()->setTemplate(static::INCLUSIVE_ERROR, 'Not smaller than or equal to :max');
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->max < $value) {
        $this->setError(static::INCLUSIVE_ERROR);
        return false;
      }
    } else if ($this->max <= $value) {
      $this->setError(self::EXCLUSIVE_ERROR);
      return false;
    }
    return true;
  }

}
