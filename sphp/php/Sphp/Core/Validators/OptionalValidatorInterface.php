<?php

/**
 * OptionalValidatorInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

/**
 * Defines the properties of an optional validator
 * 
 * An optional validator makes it possible to choose if the empty values are 
 * validated by the validation algorithm or not.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface OptionalValidatorInterface extends ValidatorInterface {

  /**
   * Sets/unsets validation for empty values
   *
   * @param  boolean $allow true if all values are validated and false if not
   * @return self for PHP Method Chaining
   */
  public function allowEmptyValues($allow = true);

  /**
   * Checks if empty values are validated or not
   *
   * @return boolean true if empty values are validated and false if not
   */
  public function emptyValuesAllowed();
}
