<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Stdlib\MessageManager;

/**
 * The base interface for a validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Validator {

  /**
   * `ID` for default error message
   */
  const INVALID = 'INVALID';

  /**
   * Validates given value
   *
   * @param  mixed $value the value to validate
   * @return bool true if validation was successful, false if not
   */
  public function isValid(mixed $value): bool;

  /**
   * Returns error messages
   *
   * @return MessageManager error messages
   */
  public function getMessages(): MessageManager;
}
