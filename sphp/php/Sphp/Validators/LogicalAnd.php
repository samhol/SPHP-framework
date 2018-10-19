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
class LogicalAnd implements ValidatorInterface, Countable {

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
    $this->validators = [];
    $this->errors = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->validators, $this->errors);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->errors = clone $this->errors;
  }

  /**
   * Invoke validator as command
   *
   * @param  mixed $value
   * @return bool
   */
  public function __invoke($value) {
    return $this->isValid($value);
  }


  public function getErrors(): array {
    return $this->errors;
  }

  /**
   * Sets the validated value
   * 
   * @param  mixed $value the validated value
   * @return $this for a fluent interface
   */
  public function setValue($value) {
    $this->reset();
    $this->value = $value;
    return $this;
  }

  /**
   * Resets the validator to for revalidation
   *
   * @return $this for a fluent interface
   */
  public function reset() {
    $this->errors = [];
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = false;
    foreach ($this->validators as $data) {
      $v = $data->validator;
      if ($data->operator === 'or') {
        $valid = $valid || $v->isValid($value);
      } else if ($data->operator === 'and') {
        $valid = $valid && $v->isValid($value);
      }
      
    }
    return $valid;
  }

  /**
   * Appends a new validator to the chain
   * 
   * @param  ValidatorInterface $v new validator object
   * @return $this for a fluent interface
   */
  public function andIs(ValidatorInterface $v) {
    $validatorData = new \stdClass();
    $validatorData->validator = $v;
    $validatorData->operator = 'and';
    $this->validators[] = $validatorData;
    return $this;
  }

  /**
   * Appends a new validator to the chain
   * 
   * @param  ValidatorInterface $v new validator object
   * @return $this for a fluent interface
   */
  public function orIs(ValidatorInterface $v) {
    $validatorData = new \stdClass();
    $validatorData->validator = $v;
    $validatorData->operator = 'or';
    $this->validators[] = $validatorData;
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
