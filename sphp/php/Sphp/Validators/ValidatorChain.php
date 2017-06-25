<?php

/**
 * ValidatorChain.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Countable;
use Sphp\I18n\Messages\TranslatableList;

/**
 * A validator container for validating a value against multiple validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ValidatorChain implements ValidatorInterface, Countable {

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
   *
   * @var MessageList
   */
  private $errors;

  /**
   * Constructs a new validator
   */
  public function __construct() {
    $this->validators = [];
    $this->errors = new TranslatableList();
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
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
   * @return self for a fluent interface
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
   * @return self for a fluent interface
   */
  public function addSkippedValue($skippedValues) {
    if (!in_array($skippedValues, $this->skippedValues, true)) {
      $this->skippedValues[] = $skippedValues;
    }
    return $this;
  }

  /**
   * 
   * @return self for a fluent interface
   */
  public function removeSkippedValues() {
    $this->skippedValues = [];
    return $this;
  }
  
  public function getErrors(): TranslatableList {
    return $this->errors;
  }

  public function isValid($value): bool {
    $this->errors->clearContent();
    $valid = true;
    if (in_array($value, $this->skippedValues, true)) {
      return true;
    }
    foreach ($this->validators as $validator) {
      $v = $validator['validator'];
      $break = $validator['break'];
      if (!$v->isValid($value)) {
        $valid = false;
        $this->getErrors()->merge($v->getErrors());
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
   * @return self for a fluent interface
   */
  public function appendValidator(ValidatorInterface $v, $break = false) {
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
