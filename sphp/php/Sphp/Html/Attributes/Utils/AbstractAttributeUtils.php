<?php

/**
 * AbstractAttributeUtils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

/**
 * Description of AttributeValueValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractAttributeUtils {

  private static $instance = [];

  /**
   * 
   * @return AbstractAttributeUtils
   */
  public static function instance(): AbstractAttributeUtils {
    if (!isset(self::$instance[static::class])) {
      self::$instance[static::class] = new static();
    }
    return self::$instance[static::class];
  }

}
