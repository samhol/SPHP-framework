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
 * Validates collection length
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CollectionLength extends AbstractValidator {

  /**
   * `ID` for error message describing values not matching lower limit
   */
  public const NOT_LARGER = 'NOT_LARGER';

  /**
   * `ID` for error message describing values not matching upper limit
   */
  public const NOT_SMALLER = 'NOT_SMALLER';

  private ?int $min;
  private ?int $max;

  /**
   * Constructor
   * 
   * @param int|null $min the minimum value
   * @param int|null $max the maximum value
   */
  public function __construct(?int $min = null, ?int $max = null) {
    parent::__construct('Array, Countable or Traversable object expected');
    $this->setMin($min)->setMax($max);
    $this->getMessages()->setTemplate(static::NOT_LARGER, 'Collection size is smaller than :min');
    $this->getMessages()->setTemplate(static::NOT_SMALLER, 'Collection size is larger than :max');
  }

  /**
   * Sets the minimum value
   * 
   * @param  int|null $min the minimum value
   * @return $this for a fluent interface
   */
  public function setMin(?int $min = null) {
    $this->min = $min;
    $this->messages->setParameter(':min', $min);
    return $this;
  }

  /**
   * Sets the maximum value
   * 
   * @param  int|null $max the maximum value
   * @return $this for a fluent interface
   */
  public function setMax(?int $max = null) {
    $this->max = $max;
    $this->messages->setParameter(':max', $max);
    return $this;
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!is_array($value) && !$value instanceof \Traversable && !$value instanceof \Countable) {
      $this->getMessages()->appendMessageFromTemplate(self::INVALID);
      return false;
    } else {
      if (is_array($value) || $value instanceof \Countable) {
        $length = count($value);
      } else {
        $length = iterator_count($value);
      }
      if ($this->min !== null && $length < $this->min) {
        $this->getMessages()->appendMessageFromTemplate(static::NOT_LARGER);
        return false;
      } else if ($this->max !== null && $length > $this->max) {
        $this->getMessages()->appendMessageFromTemplate(static::NOT_SMALLER);
        return false;
      }
    }
    return true;
  }

}
