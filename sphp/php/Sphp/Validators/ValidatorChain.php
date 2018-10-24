<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Countable;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ValidatorChain extends AbstractValidator implements Countable {

  /**
   *
   * @var array 
   */
  private $skippedValues = [];

  /**
   * used validators
   *
   * @var mixed[]
   */
  private $validators;

  /**
   * @var string[]
   */
  private $errors;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->validators = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->validators);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->errors = \Sphp\Stdlib\Arrays::copy($this->errors);
  }

  /**
   * 
   * @return array
   */
  public function getSkippedValues() {
    return $this->skippedValues;
  }

  /**
   * 
   * @param  mixed|mixed[] $skippedValues
   * @return $this for a fluent interface
   */
  public function setSkippedValues($skippedValues) {
    if (!is_array($skippedValues)) {
      $skippedValues = [$skippedValues];
    }
    $this->skippedValues = $skippedValues;
    return $this;
  }

  /**
   * 
   * @param  mixed|mixed[] $skippedValues
   * @return $this for a fluent interface
   */
  public function addSkippedValue($skippedValues) {
    if (!in_array($skippedValues, $this->skippedValues, true)) {
      $this->skippedValues[] = $skippedValues;
    }
    return $this;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function removeSkippedValues() {
    $this->skippedValues = [];
    return $this;
  }


  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    if (in_array($value, $this->skippedValues, true)) {
      return true;
    }
    foreach ($this->validators as $validator) {
      $v = $validator['validator'];
      $break = $validator['break'];
      if (!$v->isValid($value)) {
        $valid = false;
        $this->errors()->mergeCollection($v->errors());
        if ($break) {
          break;
        }
      }
    }
    return $valid;
  }

  /**
   * Appends a new validator to the chain
   * 
   * @param  ValidatorInterface $v new validator object
   * @param  boolean $break
   * @return $this for a fluent interface
   */
  public function appendValidator(Validator $v, bool $break = false) {
    $data = [
        'validator' => $v,
        'break' => (bool) $break,
    ];
    $this->validators[] = $data;
    return $this;
  }

  /**
   * Counts the number of the {@link ValidatorInterface} objects in the chain
   *
   * @return int the number of the {@link ValidatorInterface} objects
   */
  public function count(): int {
    return count($this->validators);
  }

}
