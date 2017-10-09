<?php

/**
 * AbstractAttributeValueValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Description of AttributeValueValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-09
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractAttributeValueValidator implements AttributeValueValidatorInterface {

  private static $instance = [];

  public function isValid($value): bool {
    return Strings::hasStringRepresentation($value);
  }

  /**
   * 
   * @return ClassAttributeFilter
   */
  public static function instance(): AttributeValueValidatorInterface {
    if (!isset(self::$instance[static::class])) {
      self::$instance[static::class] = new static();
    }
    return self::$instance[static::class];
  }

}
