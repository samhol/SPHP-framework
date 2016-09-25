<?php

/**
 * Numbers.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

/**
 * Utility class for multibyte string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Numbers {

  /**
   * Checks whether or not the input string contains only hexadecimal chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only hexadecimal chars, false otherwise.
   */
  public static function isHexadecimal($string, $encoding = null) {
    return Strings::match($string, '^[[:xdigit:]]*$', $encoding);
  }

  /**
   * Ordinalize an integer (in english)
   *
   * @param  scalar $num an integer to ordinalize
   * @return string ordinalize integer (in english)
   */
  public static function ordinalize($num) {
    $suff = 'th';
    $prefix = "";
    if ((int) $num < 0) {
      $prefix = "-";
    }
    $int = abs((int) $num);
    if (!in_array(($int % 100), [11, 12, 13])) {
      switch ($int % 10) {
        case 1: $suff = 'st';
          break;
        case 2: $suff = 'nd';
          break;
        case 3: $suff = 'rd';
          break;
      }
    }
    return "{$prefix}{$int}{$suff}";
  }

  /**
   * Removes redundant zeroes fron the decimal number
   *
   * @param  string|float $decimal the decimal number
   * @return string cleaned decimal number as a string
   */
  public static function cleanDecimal($decimal) {
    return trim(trim($decimal, '0'), '.');
  }

}
