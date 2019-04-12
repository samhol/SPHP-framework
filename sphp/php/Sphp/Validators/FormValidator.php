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
 * Validates given form data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FormValidator extends AbstractValidator {

  /**
   * inner validators
   * 
   * @var Validator[]
   */
  private $validators;

  /**
   * Constructs a new validator
   */
  public function __construct() {
    parent::__construct();
    $this->validators = [];
  }

  public function __destruct() {
    unset($this->validators);
    parent::__destruct();
  }

  public function isValid($value): bool {
    $this->setValue($value);
    $valid = true;
    foreach ($this->validators as $inputName => $validator) {
      $inputValue = $value[$inputName] ?? null;
      if (!$validator->isValid($inputValue)) {
        $valid = false;
        $this->errors()[$inputName] = $validator->errorsToArray();
      }
    }
    if (!$valid) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
    }
    return $valid;
  }

  /**
   * Checks whether any validators exists for the input name
   * 
   * @param  string $inputName the name of the validable input
   * @return boolean true if the input name has validators attached to it, false if not
   */
  public function hasValidator(string $inputName): bool {
    return isset($this->validators[$inputName]);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @return Validator|null the validator object or null
   */
  public function getValidator(string $inputName) {
    if ($this->hasValidator($inputName)) {
      return $this->validators[$inputName];
    }
    throw new \Sphp\Exceptions\OutOfBoundsException;
  }

  /**
   * Sets a validator object for the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @param  Validator $validator the validator object
   * @return $this for a fluent interface
   */
  public function setValidator(string $inputName, Validator $validator) {
    $this->validators[$inputName] = $validator;
    return $this;
  }

  public function getInputErrors(): array {
    $output = [];
    foreach ($this->validators as $inputName => $validator) {
      $output[$inputName] = $validator->errorsToArray();
    }
    return $output;
  }

}
