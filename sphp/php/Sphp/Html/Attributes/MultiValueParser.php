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
use Sphp\Stdlib\Parsers\Variables;

/**
 * Description of CssClassParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MultiValueParser {

  const BOOL = 0b1;
  const INT = 0b10;
  const FLOAT = 0b100;
  const STRING = 0b1000;
  const NULL = 0b10000;
  const SCALAR = 0b11110;
  const ALL = 0b11111;
  const NUMERIC = 0b110;
  const STRING_LIKE = 0b1110;

  /**
   * @var \stdClass
   */
  private $props;

  public function __construct($properties = null) {
    $this->props = new \stdClass;
    if ($properties === null) {
      $properties = new \stdClass;
      ;
    } else {
      $properties = (object) $properties;
    }
    $this->props->delim = $properties->delim ?? ' ';
    $this->props->type = $properties->type ?? self::ALL;
    $this->props->length = (int) $properties->type ?? PHP_INT_MAX;
    //$this->props->foo = $this->props->foo ?? 'nobody';
    // var_dump($this->props);
    // var_dump((object) []);
  }

  public function manipulateAtomicValue($value) {
    if ($this->props->type === self::STRING) {
      return Variables::parseString($value);
    } else if ($this->props->type === self::INT) {
      return Variables::parseInt($value);
    } else if ($this->props->type === self::FLOAT) {
      return Variables::parseFloat($value);
    } else if ($this->props->type === self::BOOL) {
      return Variables::parseBoolean($value);
    } else if ($this->props->type === self::SCALAR) {
      if (!is_scalar($value)) {
        throw new InvalidArgumentException('öjöjöjööjöjöjöjööjöjöjööj!!');
      }
      return $value;
    } else {
      return $value;
    }
  }

  protected function setArrayType(array $parsed) {
    $changer = function($raw) {
      if ($this->props->type === 'int') {
        return filter_var($raw, FILTER_VALIDATE_INT);
      } else if ($this->props->type === 'float') {
        return filter_var($raw, FILTER_VALIDATE_FLOAT);
      }
      return "$raw";
    };
    return array_map([$this, 'manipulateAtomicValue'], $parsed);
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
      return $this->setArrayType($raw);
    } else if (is_scalar($raw)) {
      return $this->parseScalar($raw);
    } else {
      throw new InvalidArgumentException('Cannot parse raw value');
    }
  }

  /**
   * 
   * @param  type $subject
   * @return array
   * @throws InvalidArgumentException
   */
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

  /**
   * 
   * @param  string $subject
   * @return array
   * @throws InvalidArgumentException
   */
  public function parseStringToArray(string $subject): array {
    $result = preg_split('/[' . $this->props->delim . ']+/', $subject, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      throw new InvalidArgumentException("$subject is shit");
    }
    return $result;
  }

  public function explode(string $string): array {
    $parts = explode($this->props->delim, $string);
    $this->setArrayType($parts);
  }

  /**
   * 
   * @param array $array
   * @return string
   */
  public function parseArrayToString(array $array): string {
    $output = '';
    if (!empty($array)) {
      $output = implode($this->props->delim, $array);
    }
    return $output;
  }

}
