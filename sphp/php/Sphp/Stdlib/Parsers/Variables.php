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
 * Description of VariableTypeParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Variables {

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
