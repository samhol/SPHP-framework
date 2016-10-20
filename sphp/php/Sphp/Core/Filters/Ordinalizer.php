<?php

/**
 * IntegerToRomanFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

/**
 * Filter converts a numeric input value to corresponding ordinal (in english)
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

  public function filter($variable) {
    if (is_numeric($variable)) {
      $suff = 'th';
      $prefix = '';
      if ((int) $variable < 0) {
        $prefix = "-";
      }
      $int = abs((int) $variable);
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
    return $variable;
  }

}
