<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of CssClassParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CssClassParser implements AttributeValueParser {

  private static $instance;

  public function __invoke($raw, bool $validate = false): array {
    return $this->parse($raw, $validate);
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
   * @param  bool $validate
   * @return string[] separated unique atomic values in an array
   * @throws InvalidArgumentException if validation is set and the input is not valid
   */
  public function parse($raw, bool $validate = false): array {
    $parsed = [];
    if (is_array($raw)) {
      $flat = Arrays::flatten($raw);
      foreach ($flat as $item) {
        $parsed = array_merge($parsed, $this->parse($item, $validate));
      }
      //$vals = array_filter($parsed, 'is_string');
    } else if (is_scalar($raw)) {
      $parsed = $this->explode("$raw");
    } else {
      throw new InvalidArgumentException("Invalid attribute value");
    }
    if ($validate) {
      foreach ($parsed as $value) {
        if (!$this->isValidAtomicValue($value)) {
          throw new InvalidArgumentException("Invalid attribute value '$value'");
        }
      }
    }
    return $parsed;
  }

  public function explode(string $subject): array {
    $result = preg_split('/[\s]+/', $subject, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return $result;
  }

  /**
   * 
   * @param array $value
   * @return bool
   * @throws InvalidArgumentException
   */
  public function validateCollection(array $value): bool {
    foreach ($value as $value) {
      if (!$this->isValidAtomicValue($value)) {
        throw new InvalidArgumentException("Invalid attribute value '$value'");
      }
    }
  }

  public function isValidAtomicValue($value): bool {
    if (!is_string($value)) {
      return false;
    }
    return preg_match("/^[_a-zA-Z]+[_a-zA-Z0-9-]*/", $value) === 1;
  }

  public function implode(array $subject): string {
    return implode(' ', $subject);
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
