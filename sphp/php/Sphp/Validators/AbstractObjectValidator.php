<?php

/**
 * AbstractObjectValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Validators;

use Sphp\Core\I18n\TopicList;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Stdlib\Arrays;

/**
 * Validates a given form data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractObjectValidator implements ValidatorInterface {

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
   * Constructs a new validator
   */
  public function __construct() {
    $this->errors = new TopicList();
    $this->validators = new Collection();
  }

  /**
   * Resets the validator to for revalidation
   * 
   * @return self for a fluent interface
   */
  protected function reset() {
    $this->errors->clearContent();
    return $this;
  }

  public function getErrors() {
    return $this->errors;
  }

  public function isValid($data) {
    $this->reset();
    foreach ($this->validators as $inputName => $validator) {
      $value = Arrays::getValue($data, $inputName);
      if (!$validator->validate($value)->isValid()) {
        $this->errors->set($inputName, $validator->getErrors());
      }
    }
    return $this;
  }

  /**
   * Sets the validator object for the named object value (property)
   * 
   * @param  string $property the name of the object value (property)
   * @param  ValidatorInterface $validator validator object
   * @return self for a fluent interface
   */
  protected function set($property, ValidatorInterface $validator) {
    $this->validators->offsetSet($property, $validator);
    return $this;
  }

  /**
   * Gets the validator object for the named object value (property)
   * 
   * @param  string $property the name of the object value (property)
   * @return ValidatorInterface|null the corresponding validator object
   */
  protected function get($property) {
    return $this->validators->offsetGet($property);
  }

  /**
   * Removes the validator object from the named object value (property)
   *
   * @param string $property the name of the object value (property)
   * @return self for a fluent interface
   */
  protected function remove($property) {
    $this->validators->offsetUnset($property);
    return $this;
  }

}
