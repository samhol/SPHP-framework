<?php

/**
 * GreaterThanValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Description of GreaterThanValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class GreaterThanValidator extends AbstractValidator {

  /**
   * Whether to do inclusive comparisons, allowing equivalence to max
   *
   * If false, then strict comparisons are done, and the value may equal
   * the min option
   *
   * @var boolean
   */
  private $inclusive;
  private $min;

  /**
   * 
   * @return type
   */
  public function getInclusive() {
    return $this->inclusive;
  }

  /**
   * 
   * @return type
   */
  public function getMin() {
    return $this->min;
  }

  /**
   * 
   * @param type $inclusive
   * @return $this
   */
  public function setInclusive($inclusive) {
    $this->inclusive = $inclusive;
    return $this;
  }

  /**
   * 
   * @param type $min
   * @return $this
   */
  public function setMin($min) {
    $this->min = $min;
    return $this;
  }

  public function isValid($value) {
    $this->setValue($value);
    if ($this->inclusive) {
      if ($this->min > $value) {
        $this->error(self::NOT_GREATER_INCLUSIVE);
        return false;
      }
    } else {
      if ($this->min >= $value) {
        $this->error(self::NOT_GREATER);
        return false;
      }
    }

    return true;
  }

}
