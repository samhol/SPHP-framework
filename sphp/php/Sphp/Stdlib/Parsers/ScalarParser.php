<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
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

  /**
   * Parses a variable to integer value
   * 
   * @param  mixed $value
   * @return int parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to integer
   */
  public static function parseInt($value): int {
    if (is_bool($value)) {
      $validated = (int) $value;
    } else if (is_numeric($value)) {
      $validated = (int) $value;
    } else {
      $validated = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
    }
    if ($validated === null) {
      $message = sprintf('%s cannot be parsed to integer', gettype($value));
      throw new InvalidArgumentException($message);
    }
    return $validated;
  }

  /**
   * Parses a variable to float value
   * 
   * @param  mixed $value
   * @return float parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to float
   */
  public static function parseFloat($value): float {
    if (is_bool($value)) {
      $validated = (float) $value;
    } else {
      $validated = filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
    }
    if ($validated === null) {
      $type = gettype($value);
      if (is_scalar($value)) {
        $type = var_export($value, true);
      }
      $message = sprintf('%s cannot be parsed to float', $type);
      throw new InvalidArgumentException($message);
    }
    return $validated;
  }

  /**
   * Parses a variable to Boolean value
   * 
   * @param  mixed $value
   * @return bool parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to Boolean
   */
  public static function parseBoolean($value): bool {
    $validated = filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
    if ($validated === null) {
      $message = sprintf('%s cannot be parsed to boolean', gettype($value));
      throw new InvalidArgumentException($message);
    }
    return $validated;
  }

  /**
   * 
   * @param  mixed $value
   * @return scalar
   * @throws InvalidArgumentException if the value cannot be parsed to scalar
   */
  public static function parseScalar($value) {
    if (is_scalar($value)) {
      $output = $value;
    } else if (is_object($value) && method_exists($value, '__toString')) {
      $output = "$value";
    } else {
      $message = sprintf('%s type cannot be parsed to scalar', gettype($value));
      throw new InvalidArgumentException($message);
    }
    return $output;
  }

  /**
   * Parses a variable to string value
   * 
   * @param  mixed $value
   * @param  string $pattern
   * @return string parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to string
   */
  public static function parseString($value, string $pattern = null): string {
    if ($pattern !== null) {
      $validated = filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]]);
    } else {
      $validated = $value;
    }
    if ($validated === null) {
      $message = sprintf('%s cannot be parsed to boolean', gettype($value));
      throw new InvalidArgumentException($message);
    }
    return $validated;
  }

}
