<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Stdlib\Datastructures\Collection;
use Traversable;

/**
 * Validates given form data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FormValidator extends AbstractValidator implements \Countable, \IteratorAggregate {

  /**
   * @var string[] 
   */
  private $inputErrors;

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
    parent::__construct('The form has errors');
    //$this->setMessageTemplate(self::INVALID, 'The form has errors');
    $this->validators = [];
    $this->inputErrors = [];
  }

  /**
   * Returns error concerning each input messages
   * 
   * @return string[] 
   */
  public function getInputErrors(): array {
    return $this->inputErrors;
  }


  public function isValid($value): bool {
    $valid = true;
    if (!is_array($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->errors()->appendErrorFromTemplate(self::INVALID);
      return false;
    }
    foreach ($this->validators as $inputName => $validator) {
      $inputValue = $value[$inputName] ?? null;
      if (!$validator->isValid($inputValue)) {
        $valid = false;
        //var_dump($validator->getErrors());
        $this->inputErrors[$inputName] = $validator->errorsToArray();
      }
    }
    if (!$valid) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
    }
    return $valid;
  }

  /**
   * Returns the number of the validable input names
   *
   * @return int the number of the validable input names
   */
  public function count(): int {
    return $this->validators->count();
  }

  /**
   * Create a new iterator to iterate through the validators
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Collection($this->validators);
  }

  /**
   * Checks whether any validators exists for the input name
   * 
   * @param  string $inputName the name of the validable input
   * @return boolean true if the input name has validators attached to it, false if not
   */
  public function exists(string $inputName) {
    return isset($this->validators[$inputName]);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @return Validator|null the validator object or null
   */
  public function get(string $inputName) {
    if ($this->exists($inputName)) {
      return $this->validators[$inputName];
    }
    return null;
  }

  /**
   * Sets a validator object for the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @param  Validator $validator the validator object
   * @return $this for a fluent interface
   */
  public function set(string $inputName, Validator $validator) {
    $this->validators[$inputName] = $validator;
    return $this;
  }

}
