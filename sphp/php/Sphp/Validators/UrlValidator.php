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
 * Validates an URL string or an instance of {@link URL} class.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class UrlValidator extends AbstractValidator {

  public function isValid($value): bool {
    $this->setValue($value);
    if (!is_string($value)) {
      $value = (string) $value;
    }
    if (filter_var($value, \FILTER_VALIDATE_URL) === false) {
      $this->error(self::INVALID);
      return false;
    }
    return true;
  }

}
