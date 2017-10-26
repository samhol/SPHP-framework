<?php

/**
 * AttributeValueValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Default implementation of the attribute value validator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeValueValidator implements AttributeValueValidatorInterface {

  public function __invoke($value): bool {
    return Strings::hasStringRepresentation($value);
  }
  public function isValidValue($value): bool {
    return Strings::hasStringRepresentation($value);
  }

}
