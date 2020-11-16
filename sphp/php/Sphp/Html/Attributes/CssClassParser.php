<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Stdlib\Strings;
/**
 * Description of CssClassParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CssClassParser {

  private static $instance;

  public function parseString(string $string): array {
    $result = preg_split('/[\s]+/', $string, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return array_unique($result);
  }

  public function parseArray(array $raw): array {
    // $parsed = array_map([$this, 'parseString'], $raw);
    $parsed = [];
    foreach ($raw as $value) {
      $parsed = array_merge($parsed, $this->parse($value));
    }
    $unique = array_unique($parsed);
    return $unique;
  }

  /**
   * Returns an array of unique CSS class values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw raw value(s) to parse
   * @return string[] separated unique atomic values in an array
   * @throws AttributeException if the raw input is not valid
   */
  public function parse($raw): array {
    $out = [];
    if (is_object($raw) && method_exists($raw, '__toString')) {
      $raw = "$raw";
    } else if ($raw instanceof \Traversable) {
      $raw = iterator_to_array($raw);
    }
    if (is_array($raw)) {
      $out = $this->parseArray($raw);
    } else if (is_scalar($raw) || is_null($raw)) {
      $out = $this->parseString((string) $raw);
    } else {
      $type = gettype($raw);
      throw new AttributeException("PHP Type ($type) cannot be parsed to a valid class name");
    }
    return $out;
  }

  /**
   * 
   * @param array $value
   * @return bool
   * @throws InvalidArgumentException
   */
  public function isValidCollection(array $value): bool {
    $isValid = true;
    foreach ($value as $value) {
      $isValid = is_string($value) && $this->isValidClassName($value);
      if (!$isValid) {
        break;
      }
    }
    return $isValid;
  }

  public function isValidClassName(string $value) {
    return !Strings::match($value, '/[\x00-\x1F\x80-\xFF]/');
  }

  /**
   * Returns the singleton instance
   * 
   * @return CssClassParser singleton instance
   */
  public static function instance(): CssClassParser {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
