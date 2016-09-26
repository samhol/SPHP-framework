<?php

/**
 * OptionalValidatorTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Core\Types\Strings;

/**
 * Trait implements the properties of the {@link OptionalValidatorInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait OptionalValidatorTrait {

  /**
   * whether empty values are allowed or not
   *
   * var boolean
   */
  private $allowEmptyValues = true;

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

  /**
   * Does the validation
   *
   * @param  mixed $value the value to validate
   * @return self for PHP Method Chaining
   */
  public function validate($value) {
    $this->reset();
    if (!Strings::isEmpty($value) || !$this->emptyValuesAllowed()) {
      $this->executeValidation($value);
    }
    return $this;
  }

}
