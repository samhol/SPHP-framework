<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators\Datetime;

use Sphp\Validators\AbstractLimitValidator;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Implementation of InPeriod
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class InPeriod extends AbstractLimitValidator {

  /**
   * @var ImmutableDateTime 
   */
  private $min;

  /**
   * @var ImmutableDateTime 
   */
  private $max;

  /**
   * Constructs a new validator
   * 
   * @param mixed $min the minimum value
   * @param mixed $max the maximum value
   * @param boolean $inclusive
   */
  public function __construct($min, $max, bool $inclusive = true) {
    parent::__construct($inclusive);
    $this->min = $min;
    $this->max = $max;
    $this->getErrors()->setTemplate(static::EXCLUSIVE_ERROR, 'Not in exclusive period (%s, %s)');
    $this->getErrors()->setTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive period (%s, %s)');
  }

  public function __destruct() {
    unset($this->min, $this->max);
    parent::__destruct();
  }

  /**
   * 
   * @param  mixed $min
   * @param  mixed $max
   * @return $this
   */
  public function setPeriod($min, $max) {
    if (!$min instanceof ImmutableDateTime) {
      $min = new ImmutableDateTime($min);
    }
    if (!$max instanceof ImmutableDateTime) {
      $max = new ImmutableDateTime($max);
    }
    $this->min = $min;
    $this->max = $max;
    return $this;
  }

  public function getMin(): ImmutableDateTime {
    return $this->min;
  }

  public function getMax(): ImmutableDateTime {
    return $this->max;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value || $this->max < $value) {
        $this->getErrors()->appendMessageFromTemplate(static::INCLUSIVE_ERROR, $this->min, $this->max);
        return false;
      }
    } else {
      if ($this->min >= $value || $this->max <= $value) {
        $this->getErrors()->appendMessageFromTemplate(static::EXCLUSIVE_ERROR, $this->min, $this->max);
        return false;
      }
    }
    return true;
  }

}
