<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators\Datetime;

use Sphp\Validators\AbstractLimitValidator;
use Sphp\DateTime\DateTime;

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
   * @var float 
   */
  private $min;

  /**
   * @var float 
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
    $this->errors()->setTemplate(static::EXCLUSIVE_ERROR, 'Not in range (%s, %s)');
    $this->errors()->setTemplate(static::INCLUSIVE_ERROR, 'Not in inclusive range (%s, %s)');
  }

  public function setPeriod($min, $max) {
    if (!$min instanceof DateTime) {
      $min = new DateTime($min);
    }
    if (!$max instanceof DateTime) {
      $max = new DateTime($max);
    }
    $this->min = $min;
    $this->max = $max;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if ($this->isInclusive()) {
      if ($this->min > $value || $this->max < $value) {
        $this->errors()->appendErrorFromTemplate(static::INCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    } else {
      if ($this->min >= $value || $this->max <= $value) {
        $this->errors()->appendErrorFromTemplate(static::EXCLUSIVE_ERROR, [$this->min, $this->max]);
        return false;
      }
    }
    return true;
  }

}
