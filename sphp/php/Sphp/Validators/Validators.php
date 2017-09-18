<?php

/**
 * Validators.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Description of Validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Validators {

  public static function validateFormatParameters(string $format, array $arguments): bool {
    $validator = new Static($format);
    return $validator->isValid($arguments);
  }

}
