<?php

/**
 * OptionalValidator.php (UTF-8)
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
class OptionalValidator extends ValidatorChain {

  /**
   * whether empty values are allowed or not
   *
   * @var boolean
   */
  private $allowEmptyValues = true;

  /**
   * 
   * @param boolean $allowEmptyValues
   */
  public function __construct($allowEmptyValues = true) {
    parent::__construct();
    $this->allowEmptyValues($allowEmptyValues);
  }

  /**
   * Sets/unsets validation for empty values
   *
   * @param  boolean $allow true if all values are validated and false if not
   * @return self for a fluent interface
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

}
