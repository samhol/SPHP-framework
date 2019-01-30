<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates collection length
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CollectionLength extends AbstractValidator {

  /**
   * `ID` for error message describing values not matching an inclusive limit
   */
  const SMALLER_ERROR = 'SMALLER_ERROR';

  /**
   * `ID` for error message describing values not matching an exclusive limit
   */
  const LARGER_ERROR = 'LARGER_ERROR';

  /**
   * @var int 
   */
  private $min;

  /**
   * @var int 
   */
  private $max;

  /**
   * Constructor
   * 
   * @param int $min the minimum value
   * @param int $max the maximum value
   */
  public function __construct(int $min = null, int $max = null) {
    parent::__construct('Array, Countable or Traversable object expected');
    $this->setMin($min)->setMax($max);
    $this->errors()->setTemplate(static::SMALLER_ERROR, 'Collection is smaller than %d');
    $this->errors()->setTemplate(static::LARGER_ERROR, 'Collection is larger than %d');
  }

  /**
   * Sets the minimum value
   * 
   * @param  int $min the minimum value
   * @return $this for a fluent interface
   */
  public function setMin(int $min = null) {
    $this->min = $min;
    return $this;
  }

  /**
   * Sets the maximum value
   * 
   * @param  int $max the maximum value
   * @return $this for a fluent interface
   */
  public function setMax(int $max = null) {
    $this->max = $max;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!is_array($value) && !$value instanceof \Traversable && !$value instanceof \Countable) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
      return false;
    } else {
      if (is_array($value) || $value instanceof \Countable) {
        $length = count($value);
      } else {
        $length = iterator_count($value);
      }
      if ($this->min !== null && $length < $this->min) {
        $this->errors()->appendErrorFromTemplate(static::SMALLER_ERROR, [$this->min]);
        return false;
      } else if ($this->max !== null && $length > $this->max) {
        $this->errors()->appendErrorFromTemplate(static::LARGER_ERROR, [$this->max]);
        return false;
      }
    }
    return true;
  }

}
