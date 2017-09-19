<?php

/**
 * UrlValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates an URL string or an instance of {@link URL} class.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UrlValidator extends AbstractValidator {

  public function isValid($value): bool {
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
