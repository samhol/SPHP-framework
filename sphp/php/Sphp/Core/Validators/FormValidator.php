<?php

/**
 * FormValidator.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Validators;

use Sphp\Core\I18n\TopicList;
use Sphp\Data\Collection;
use Sphp\Core\Types\Arrays;

/**
 * Class validates a given formdata
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormValidator implements ValidatorInterface, \Countable, \IteratorAggregate, \ArrayAccess {

  /**
   * inner {@link InputDataValidator} validators
   *
   * @var Collection
   */
  private $validators;

  /**
   * error message container
   *
   * @var TopicList
   */
  private $errors;

  /**
   * Constructs a new {@link self} validator
   */
  public function __construct() {
    $this->errors = new TopicList();
    $this->validators = new Collection();
  }

  /**
   * Resets the validator to for revalidation
   * 
   * @return self for PHP Method Chaining
   */
  public function reset() {
    foreach ($this as $validator) {
      $validator->reset();
    }
    //$this->errors->clearContent();
    return $this;
  }

  /**
   * Returns error messages as an {@link TopicContainer} object
   *
   * @return TopicList error messages in a container
   */
  public function getErrors() {
    $this->errors->clearContent();
    foreach ($this as $inputName => $validator) {
      if (!$validator->isValid()) {
        $this->errors->set($inputName, $validator->getErrors());
      }
    }
    return $this->errors;
  }

  /**
   * Checks if the validated data is valid or not
   *
   * @return boolean true if the data is valid, false if not
   */
  public function isValid() {
    return $this->getErrors()->count(TopicList::COUNT_MESSAGES) == 0;
  }

  /**
   * Validates the form data
   *
   * @param  scalar[] $data
   * @return self for PHP Method Chaining
   */
  public function validate($data) {
    $this->reset();
    foreach ($this->validators as $inputName => $validator) {
      $validator->validate(Arrays::getValue($data, $inputName));
      //var_dump($validator->validate($data)->isValid());
      //filter_var($validator, $filter, $data)
      //var_dump($inputName, get_class($validator));
      //echo "\nsehesrhrerhe\n";
      //if (!$validator->validate($data[$inputName])->isValid()) {
      //var_dump($inputName);
      //		$this->errors->set($inputName, $validator->getErrors());
      //	}
    }
    return $this;
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
  public function offsetExists($inputName) {
    return $this->validators->offsetExists($inputName);
  }

  /**
   * Checks whether any validators exists for the input name
   * 
   * Shorthand method for {@link self::offsetExists()}
   * 
   * @param  string $inputName the name of the validable input
   * @return boolean true if the input name has validators attached to it, false if not
   * @see    self::offsetExists()
   */
  public function exists($inputName) {
    return $this->offsetExists($inputName);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @return ValidatorInterface|null the validator object or null
   */
  public function offsetGet($inputName) {
    return $this->validators->offsetGet($inputName);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * Shorthand method for {@link self::offsetGet()}
   * 
   * @param  string $inputName the name of the validable input
   * @return ValidatorInterface|null the validator object or null
   * @see    self::offsetGet()
   */
  public function get($inputName) {
    return $this->offsetGet($inputName);
  }

  /**
   * Sets a validator object for the named input value
   * 
   * @param string $inputName the name of the validable input
   * @param ValidatorInterface $value
   */
  public function offsetSet($inputName, $value) {
    $this->validators->offsetSet($inputName, $value);
  }

  /**
   * Sets a validator object for the named input value
   * 
   * Chainable shorthand method for {@link self::offsetSet()}
   * 
   * @param  string $inputName the name of the validable input
   * @param  ValidatorInterface $validator the validator object
   * @return self for PHP Method Chaining
   * @see    self::offsetSet()
   */
  public function set($inputName, ValidatorInterface $validator) {
    $this->offsetSet($inputName, $validator);
    return $this;
  }

  /**
   * Removes the validator object of the named input
   * 
   * @param string $inputName the name of the validable input
   */
  public function offsetUnset($inputName) {
    $this->validators->offsetUnset($inputName);
  }

  /**
   * Removes the validator object of the named input
   *
   * Chainable shorthand method for {@link self::offsetUnset()}
   * 
   * @param  string $inputName the name of the validable input
   * @return self for PHP Method Chaining
   * @see    self::offsetUnset()
   */
  public function remove($inputName) {
    $this->offsetUnset($inputName);
    return $this;
  }

}
