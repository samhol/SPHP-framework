<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

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

  private static ?CssClassParser $instance = null;

  /**
   * Explodes a string containing CSS class names separated by whitespace characters
   * 
   * @param  string $string a string to explode
   * @return string[] an array containing separated CSS class names
   */
  protected function explodeString(string $string): array {
    $result = preg_split('/[\s]+/', $string, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return $result;
  }

  /**
   * Parses a collection of raw CSS class names to an array of individual class names
   * 
   * @param  iterable $raw a collection of raw CSS class names
   * @return string[] an array of individual class names
   * @throws AttributeException if the raw input is not valid
   */
  protected function parseCollection(iterable $raw): array {
    // $parsed = array_map([$this, 'parseString'], $raw);
    $parsed = [];
    foreach ($raw as $value) {
      $parsed = array_merge($parsed, $this->parse($value));
    }
    return $parsed;
  }

  /**
   * Returns an array of unique CSS class values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values and empty strings are ignored
   *
   * @param  mixed $raw raw value(s) to parse
   * @return string[] separated unique atomic values in an array
   * @throws AttributeException if the raw input is not valid
   */
  public function parse($raw): array {
    $out = [];
    if (is_iterable($raw)) {
      $out = $this->parseCollection($raw);
    } else if (is_string($raw)) {
      $out = $this->explodeString($raw);
    } else {
      $type = gettype($raw);
      throw new AttributeException("PHP Type ($type) cannot be parsed to a valid class name");
    }
    return array_filter(array_unique($out), fn($x) => !Strings::match($x, '/[\s]+/'));
  }

  /**
   * Checks if the collection contains only valid class names
   * 
   * @param  iterable $collection the class name collection to check
   * @return bool true if the collection contains only valid class names, false otherwise 
   */
  public function isValidClassNameCollection(iterable $collection): bool {
    $isValid = true;
    foreach ($collection as $collection) {
      $isValid = is_string($collection) && $this->isValidClassName($collection);
      if (!$isValid) {
        break;
      }
    }
    return $isValid;
  }

  /**
   * Checks if the class name is valid
   * 
   * @param string $className the class name to check
   * @return bool true if the class name is valid, false otherwise 
   */
  public function isValidClassName(string $className): bool {
    return Strings::match($className, '/^-?[_a-zA-Z]+[_a-zA-Z0-9-]*$/');
  }

  /**
   * Returns the singleton instance
   * 
   * @return CssClassParser singleton instance
   */
  public static function singelton(): CssClassParser {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
