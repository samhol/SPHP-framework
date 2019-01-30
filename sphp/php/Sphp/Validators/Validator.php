<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * The base interface for a validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Validator {

  /**
   * `ID` for default error message
   */
  const INVALID = '_invalid_';

  /**
   * Validates given value
   *
   * @param  mixed $value the value to validate
   * @return boolean true if validation was successful, false if not
   */
  public function isValid($value): bool;

  /**
   * Returns error messages
   *
   * @return string[] error messages
   */
  public function errors(): ErrorMessages;

  /**
   * Returns error messages
   *
   * @return string[] error messages
   */
  public function errorsToArray(): array;
}
