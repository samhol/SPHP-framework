<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\I18n\Collections\TranslatableCollection;
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
   * @var TranslatableCollection 
   */
  private $inputErrors;

  /**
   * inner validators
   * 
   * @var ValidatorInterface[]
   */
  private $validators;

  /**
   * Constructs a new validator
   */
  public function __construct() {
    parent::__construct('The form has errors');
    $this->setMessageTemplate(self::INVALID, 'The form has errors');
    $this->validators = [];
    $this->inputErrors = new TranslatableCollection();
  }

  /**
   * Returns error concerning each input messages
   * 
   * @return TranslatableCollection
   */
  public function getInputErrors(): TranslatableCollection {
    return $this->inputErrors;
  }

  /**
   * Resets the validator to for revalidation
   * 
   * @return $this for a fluent interface
   */
  public function reset() {
    foreach ($this->validators as $validator) {
      $validator->reset();
    }
    $this->inputErrors->clearContent();
    parent::reset();
    return $this;
  }

  public function isValid($value): bool {
    $this->reset();
    $valid = true;
    if (!is_array($value)) {
      //echo 'Invalid type given. String, integer or float expected';
      $this->error(self::INVALID);
      return false;
    }
    foreach ($this->validators as $inputName => $validator) {
      $inputValue = $value[$inputName] ?? null;
      if (!$validator->isValid($inputValue)) {
        $valid = false;
        //var_dump($validator->getErrors());
        $this->inputErrors->offsetSet($inputName, $validator->getErrors());
      }
    }
    if (!$valid) {
      $this->error(self::INVALID);
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
   * @return ValidatorInterface|null the validator object or null
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
   * @param  ValidatorInterface $validator the validator object
   * @return $this for a fluent interface
   */
  public function set(string $inputName, ValidatorInterface $validator) {
    $this->validators[$inputName] = $validator;
    return $this;
  }

}
