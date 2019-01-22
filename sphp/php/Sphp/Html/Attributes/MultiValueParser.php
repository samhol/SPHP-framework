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
class MultiValueParser {

  /**
   * @var \stdClass
   */
  private $properties;

  public function __construct($properties = null) {
    if ($properties === null) {
      $properties = [];
    }
    $this->properties['delim'] = $properties['delim'] ?? ' ';
    $this->properties['type'] = $properties['type'] ?? 'scalar';
    $this->properties = (object) $this->properties;
  }

  /**
   * 
   * @param  array $raw
   * @return array
   */
  public function parseRawArray(array $raw): array {
    $result = [];
    foreach ($raw as $key => $item) {
      if (is_array($item)) {
        $result[$key] = $this->parseRawArray($item);
      } else {
        $result[$key] = $this->parseScalar($item);
      }
    }
    return $this->setArrayType(Arrays::flatten($result));
  }

  protected function setArrayType(array $parsed) {
    $changer = function($raw) {
      if ($this->properties->type === 'int') {
        return filter_var($raw, FILTER_VALIDATE_INT);
      } else if ($this->properties->type === 'float') {
        return filter_var($raw, FILTER_VALIDATE_FLOAT);
      }
      return "$raw";
    };
    return array_map($changer, $parsed);
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
   * @param  mixed $raw the value(s) to parse
   * @return array separated unique atomic values in an array
   * @throws InvalidArgumentException if validation is set and the input is not valid
   */
  public function parseRaw($raw): array {
    if (is_array($raw)) {
      return $this->parseRawArray($raw);
    } else if (is_scalar($raw)) {
      return $this->parseScalar($raw);
    } else {
      throw new InvalidArgumentException('Cannot parse raw value');
    }
  }

  /**
   * Validates given atomic value
   * 
   * @param  mixed $value an atomic value to validate
   * @return bool true if the value is valid atomic value
   */
  public function isValidAtomicValue($value): bool {
    if ($this->properties->type === 'int') {
      return is_int($value);
    }
    if ($this->properties->type === 'float') {
      return is_float($value);
    }
    return is_scalar($value);
  }

  public function parseScalar($subject): array {
    $output = [];
    if (is_string($subject)) {
      $output = $this->parseStringToArray($subject);
    } else if (is_numeric($subject)) {
      $output = [$subject];
    } else {
      throw new InvalidArgumentException("$subject is shit");
    }
    return $this->setArrayType($output);
  }

  public function parseStringToArray(string $subject): array {
    $result = preg_split('/[' . $this->properties->delim . ']+/', $subject, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      throw new InvalidArgumentException("$subject is shit");
    }
    return $result;
  }

  public function parseArrayToString(array $array): string {
    $output = '';
    if (!empty($array)) {
      $output = implode($this->properties->delim, $array);
    }
    return $output;
  }

}
