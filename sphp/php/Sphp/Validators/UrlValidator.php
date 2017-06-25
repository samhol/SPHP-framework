<?php

/**
 * UrlValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\URL;

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
    if (!($value instanceof URL)) {
      $value = new URL($value);
    }
    if (!$value->exists()) {
      $this->error(self::INVALID);
    }
  }

}
