<?php

/**
 * IdValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Implements an HTML id attribute value validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdValidator implements AttributeValueValidatorInterface {

  public function isValidValue($value): bool {
    return is_string($value) && !Strings::match($value, '/[\r\n\r\n|\r\r|\n\n]/');
  }

}
