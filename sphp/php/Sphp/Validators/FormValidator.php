<?php

/**
 * FormValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Validators;

use Sphp\I18n\TopicList;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Stdlib\Arrays;

/**
 * Validates given form data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormValidator extends AbstractValidator implements \Countable, \IteratorAggregate {

  /**
   *
   * @var TopicList 
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
    parent::__construct();
    $this->createMessageTemplate(self::INVALID, 'The form has errors');
    $this->validators = [];
    $this->inputErrors = new TopicList();
  }

  public function getInputErrors() {
    return $this->inputErrors;
  }

  /**
   * Resets the validator to for revalidation
   * 
   * @return self for a fluent interface
   */
  public function reset() {
    foreach ($this->validators as $validator) {
      $validator->reset();
    }
    $this->inputErrors->clearContent();
    parent::reset();
    return $this;
  }

  public function isValid($value) {
    $this->reset();
    $valid = true;
    foreach ($this->validators as $inputName => $validator) {
      if (!$validator->isValid(Arrays::getValue($value, $inputName))) {
        $valid = false;
        //var_dump($validator->getErrors());
        $this->inputErrors->offsetSet($inputName, $validator->getErrors());
      }
    }
    if (!$valid) {
      $this->fromMessageTemplate(self::INVALID);
    }
    return $valid;
  }

  /**
   * Returns the number of the validable input names
   *
   * @return int the number of the validable input names
   */
  public function count() {
    return $this->validators->count();
  }

  /**
   * Create a new iterator to iterate through the {@link ValidatorInterface}
   * objects in aggregate
   *
   * @return Collection iterator
   */
  public function getIterator() {
    return $this->validators;
  }

  /**
   * Checks whether any validators exists for the input name
   * 
   * @param  string $inputName the name of the validable input
   * @return boolean true if the input name has validators attached to it, false if not
   */
  public function exists($inputName) {
    return array_key_exists($inputName, $this->validators);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @return ValidatorInterface|null the validator object or null
   */
  public function get($inputName) {
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
   * @return self for a fluent interface
   */
  public function set($inputName, ValidatorInterface $validator) {
    $this->validators[$inputName] = $validator;
    return $this;
  }

}
