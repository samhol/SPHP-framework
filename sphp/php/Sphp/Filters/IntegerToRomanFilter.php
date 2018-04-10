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
   */
  public function filter($value) {
    //var_dump($value, filter_var($value, FILTER_VALIDATE_INT, ["options" => ["minRange" => 1, "default" => 0]]));
    $intVal = filter_var($value, FILTER_VALIDATE_INT, ["options" => ["minRange" => 1, "default" => 0]]);
    if (is_numeric($value) && $intVal > 0) {
      $n = $intVal;
      $res = '';
      $roman_numerals = [
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
      foreach ($roman_numerals as $roman => $number) {
        $matches = intval($n / $number);
        $res .= str_repeat($roman, $matches);
        $n = $n % $number;
      }
      return $res;
    } else {
      return $value;
    }
  }

}
