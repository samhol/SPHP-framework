<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

/**
 * Description of VariableTypeParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VariableTypeParser {

  /**
   * Parses a variable to integer value
   * 
   * @param  mixed $value
   * @return int parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to integer
   */
  public static function parseInt($value): int {
    $validated = filter_var($value, FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
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
    $validated = filter_var($value, FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
    if ($validated === null) {
      $message = sprintf('%s cannot be parsed to float', gettype($value));
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
   * Parses a variable to string value
   * 
   * @param  mixed $value
   * @return string parsed value
   * @throws InvalidArgumentException if the value cannot be parsed to string
   */
  public static function parseString($value, string $pattern = null): bool {
    if (!is_string($value)) {
      $value = strval($value);
    }
    if ($pattern !== null) {
      $validated = filter_var($value, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $pattern]]);
    }
    if ($validated === null) {
      $message = sprintf('%s cannot be parsed to boolean', gettype($value));
      throw new InvalidArgumentException($message);
    }
    return $validated;
  }

}
