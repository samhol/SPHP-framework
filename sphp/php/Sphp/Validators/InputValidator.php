<?php

/**
 * AbstractOptionalValidator.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Abstract superclass for an optional validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputValidator extends AbstractValidator {

  /**
   * whether empty values are allowed or not
   *
   * var boolean
   */
  private $allowEmptyValues = true;
  private $inputName;

  public function __construct($inputName, $allowEmptyValues = true) {
    parent::__construct();
    $this->setInputName($inputName)->allowEmptyValues($allowEmptyValues);
  }

  public function getInputName() {
    return $this->inputName;
  }

  /**
   * 
   * @param string $inputName
   * @return self for PHP Method Chaining
   */
  public function setInputName($inputName) {
    $this->inputName = $inputName;
    return $this;
  }

  /**
   * Sets/unsets validation for empty values
   *
   * @param  boolean $allow true if all values are validated and false if not
   * @return self for PHP Method Chaining
   */
  public function allowEmptyValues($allow = true) {
    $this->allowEmptyValues = $allow;
    return $this;
  }

  /**
   * Checks if empty values are validated or not
   *
   * @return boolean true if empty values are validated and false if not
   */
  public function emptyValuesAllowed() {
    return $this->allowEmptyValues;
  }

  public function isValid($value) {
    $this->setValue($value);
    if (!Strings::isEmpty($value) || !$this->emptyValuesAllowed()) {
      $this->executeValidation($value);
    }
    return $this;
  }

}
