<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core\DataOptions;

/**
 * Description of DataOptionTools
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DataOptionTools {

  /**
   * Transforms option name to data attribute name
   * 
   * @param  string $string
   * @return string data attribute name
   */
  public static function toDataAttribute(string $string): string {
    $kebab = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', '-$1', $string));
    if (substr($kebab, 0, 5) !== 'data-') {
      $kebab = "data-$kebab";
    }
    return $kebab;
  }

  /**
   * Transforms data attribute name to option name
   * 
   * @param string $param
   * @return string
   */
  public static function toOptionName(string $param): string {
    if (substr($param, 0, 5) == 'data-') {
      $param = substr($param, 5);
    }
    return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $param))));
  }

  /**
   * Parses an option value
   * 
   * @param  mixed $value raw option value
   * @return string|float parsed option value
   */
  public static function parseValue($value) {
    if (is_bool($value)) {
      $value = $value ? 'true' : 'false';
    }
    return $value;
  }

}
