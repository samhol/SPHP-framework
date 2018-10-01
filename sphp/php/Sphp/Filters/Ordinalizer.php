<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

/**
 * Filter converts a numeric input value to corresponding ordinal (in English)
 * 
 * * All non negative integer values remain unchanged. 
 * * A variable is considered as an integer if it contains only numbers 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
          case 1:
            $suff = 'st';
            break;
          case 2:
            $suff = 'nd';
            break;
          case 3:
            $suff = 'rd';
            break;
        }
      }
      return "{$prefix}{$int}{$suff}";
    }
    return $variable;
  }

}
