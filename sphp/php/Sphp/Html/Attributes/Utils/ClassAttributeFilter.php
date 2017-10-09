<?php

/**
 * ClassAttributeFilter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * Description of ClassAttributeFilter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClassAttributeFilter extends AbstractAttributeValueValidator {

  /**
   * Returns an array of unique values parsed from the input
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
   * @throws InvalidAttributeException
   */
  public function filter($raw, bool $validate = false): array {
    $parsed = [];
    if (is_array($raw)) {
      $parsed = array_unique(Arrays::flatten($raw));
    } else if ($raw instanceof MultiValueAttribute) {
      $parsed = $raw->toArray();
    } else if (Strings::hasStringRepresentation($raw)) {
      $parsed = [Strings::toString($raw)];
    } else {
      throw new InvalidAttributeException("Value cannot be converted to string");
    }
    if ($validate) {
      foreach ($parsed as $value) {
        if (!$this->isValid($value)) {
          throw new InvalidAttributeException("invalid value '$value'");
        }
      }
    }
    return $parsed;
  }

  /**
   * 
   * @param  mixed $string
   * @return bool
   */
  public function isValid($string): bool {
    if (!is_string($string)) {
      return false;
    }
    return preg_match("/^[_a-zA-Z]+[_a-zA-Z0-9-]*/", $string) === 1;
  }

}
