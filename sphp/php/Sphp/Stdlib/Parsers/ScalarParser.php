<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Provides static methods for some simple scalar operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class ScalarParser {

  /**
   * Converts an integer value to a corresponding roman numeral
   * 
   * @param  int $value the value to convert
   * @return string the filtered value
   * @throws InvalidArgumentException if input value cannot be parsed to Roman numeral
   */
  public static function integerToRoman(int $value): string {
    if ($value <= 0) {
      throw new InvalidArgumentException('Negative integer value cannot be parsed to Roman numeral');
    }
    $n = $value;
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

  /**
   * Converts an integer value to corresponding ordinal (in English)
   * 
   * @param int $value the value to convert
   * @return string ordinal
   * @throws InvalidArgumentException if input value cannot be parsed to Roman numeral
   */
  public static function ordinalize(int $value): string {
    if ($value <= 0) {
      throw new InvalidArgumentException('Negative integer value cannot be parsed to ordinal');
    }
    $suff = 'th';
    $int = abs((int) $value);
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
    return "{$int}{$suff}";
  }

}
