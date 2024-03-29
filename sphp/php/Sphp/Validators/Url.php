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

/**
 * Validates an URL string or an instance of {@link URL} class.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Url extends AbstractValidator {

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!is_string($value) && !$value instanceof \Sphp\Network\URL) {
      $this->getMessages()->appendMessageFromTemplate(self::INVALID);
    }
    if (filter_var($value, \FILTER_VALIDATE_URL) === false) {
      $this->getMessages()->appendMessageFromTemplate(self::INVALID);
      return false;
    }
    return true;
  }

}
