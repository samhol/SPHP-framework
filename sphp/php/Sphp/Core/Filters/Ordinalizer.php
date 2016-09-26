<?php

/**
 * IntegerToRomanFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

/**
 * Filter converts a numeric input value to a corresponding roman numeral
 * 
 * * All non negative integer values remain unchanged. 
 * * value is consideserd as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Ordinalizer extends AbstractFilter {

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   */
  /**
   * Ordinalize an integer (in english)
   *
   * @param  scalar $num an integer to ordinalize
   * @return string ordinalize integer (in english)
   */
  public function filter($num) {
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

}
