<?php

/**
 * ClassAttributeUtils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Arrays;

/**
 * Utility class to handle values of class attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClassAttributeUtils extends MultiValueAttributeUtils {

  /**
   * Returns an array of unique CSS class values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @param  bool $validate
   * @return string[] separated atomic values in an array
   * @throws InvalidAttributeException if validation is set and the input is not valid
   */
  public function filter($raw, bool $validate = false): array {
    $parsed = [];
    if (is_array($raw)) {
      $parsed = Arrays::flatten($raw);
    } else {
      $parsed = [$raw];
    }
    $vals = array_filter($parsed, 'is_string');
    if ($validate) {
      foreach ($vals as $value) {
        if (!$this->isValidAtomicValue($value)) {
          throw new InvalidAttributeException("Invalid attribute value '$value'");
        }
      }
    }
    return $vals;
  }

  public function isValidAtomicValue($value): bool {
    if (!is_string($value)) {
      return false;
    }
    return preg_match("/^[_a-zA-Z]+[_a-zA-Z0-9-]*/", $value) === 1;
  }

}



