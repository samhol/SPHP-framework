<?php

/**
 * ClassAttributeUtils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Utility class to handle values of class attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClassAttributeUtils extends MultiValueAttributeUtils {

  public function isValidAtomicValue($value): bool {
    if (!is_string($value)) {
      return false;
    }
    return preg_match("/^[_a-zA-Z]+[_a-zA-Z0-9-]*/", $value) === 1;
  }

  public function __invoke($value): bool {
    return Strings::hasStringRepresentation($value);
  }

}
