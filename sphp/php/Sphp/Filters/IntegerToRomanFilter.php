<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Sphp\Exceptions\RuntimeException;

/**
 * Filter converts a numeric input value to a corresponding roman numeral
 * 
 * * All non negative integer values remain unchanged. 
 * * value is considered as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IntegerToRomanFilter extends AbstractFilter {

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $value the value to filter
   * @return mixed the filtered value
   * @throws RuntimeException if input value cannot be parsed to Roman numeral
   */
  public function filter($value) {
    if (!is_numeric($value) || (int) $value <= 0) {
      throw new RuntimeException('Input value cannot be parsed to Roman numeral');
    }
    $n = (int) $value;
    $res = '';
    $romans = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];
    foreach ($romans as $roman => $number) {
      $matches = intval($n / $number);
      $res .= str_repeat($roman, $matches);
      $n = $n % $number;
    }
    return $res;
  }

}
