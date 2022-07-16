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

use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Stdlib\Strings;

/**
 * Description of PropertyParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PropertyParser {

  public const DEF_SEPARATOR = ';';
  public const PROP_SEPARATOR = ':';
  public const INVALID_PATTERN = '/(^[\s"]?$)|["]+/';

  /**
   * @var PropertyParser[]
   */
  private static array $instance = [];
  private string $defSep = ';';
  private string $propSep = ':';
  private string $invalidPattern = '/[^\s"]+/';

  /**
   * Constructor
   * 
   * @param  string $delim
   * @param  string $sep 
   * @throws InvalidArgumentException
   */
  public function __construct(string $delim = ':', string $sep = ';') {
    if ($delim === '' || $sep === '') {
      throw new InvalidArgumentException('Either Delimeter or separator cannot be empty');
    }
    if ($delim === $sep) {
      throw new InvalidArgumentException('Delimeter and separator cannot be the same');
    }
    $this->propSep = $delim;
    $this->defSep = $sep;
  }

  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string|array $properties properties to parse
   * @return array<string, scalar> parsed property array containing name value pairs
   * @throws AttributeException if the input data is invalid
   */
  public function parse($properties): array {
    if (is_iterable($properties)) {
      foreach ($properties as $property => $value) {
        if (!$this->isValidProperty($property, $value)) {
          throw new AttributeException("Property '$property' is not valid");
        }
      }
    } else if (is_string($properties)) {
      $properties = $this->parseStringToProperties($properties);
    } else {
      throw new AttributeException("Invalid datatype provided");
    }
    return $properties;
  }

  /**
   * Validates a given property name 
   * 
   * @param  string|int $name the name of the property
   * @return bool true if the property name is valid
   */
  public function isValidPropertyName(string|int $name): bool {
    return is_string($name) && $name !== '' && !Strings::match($name, self::INVALID_PATTERN);
  }

  /**
   * Validates a given value
   * 
   * @param  mixed $value the value of the property
   * @return bool true if the property value is valid
   */
  public function isValidValue($value): bool {
    return is_scalar($value) && $value !== '' && !Strings::match((string) $value, self::INVALID_PATTERN);
  }

  /**
   * Validates a given property name => value pair 
   * 
   * @param  mixed $name the name of the property
   * @param  mixed $value the value of the property
   * @return bool true if the property name => value pair is valid
   */
  public function isValidProperty(string $name, $value): bool {
    return $this->isValidValue($value) && $this->isValidPropertyName($name);
  }

  /**
   * Parses a property string to an array containing propertyname => value pairs
   * 
   * @param  string $css
   * @return array<string, scalar> parsed property array containing name value pairs
   * @throws AttributeException if the inline CSS is invalid
   */
  public function parseStringToProperties(string $css): array {
    try {
      $attrs = explode(static::DEF_SEPARATOR, trim($css, $this->defSep));
      $parsed = [];
      foreach ($attrs as $attr) {
        $first_colon_pos = strpos($attr, static::PROP_SEPARATOR);
        $key = trim(substr($attr, 0, $first_colon_pos));
        $value = trim(substr($attr, $first_colon_pos + 1));
        if (!$this->isValidProperty($key, $value)) {
          throw new AttributeException("Property $key => $value is not valid");
        }
        $parsed[$key] = $value;
      }
      return $parsed;
    } catch (\TypeError $ex) {
      throw new AttributeException("String '$css' is not valid property string", $ex->getCode(), $ex);
    }
  }

  /**
   * Returns the given property as string
   * 
   * @param  string $name the name of the property
   * @param  scalar $value the value of the property
   * @return string the given property as string
   */
  public function propertyToString(string $name, $value): string {
    return "$name{$this->propSep}$value";
  }

  /**
   * Returns given properties as string
   *
   * @param  array $props properties to parse
   * @return string given properties as string
   */
  public function propertiesToString(array $props): string {
    $output = '';
    foreach ($props as $name => $value) {
      $output .= $this->propertyToString($name, $value) . $this->defSep;
    }
    return $output;
  }

  /**
   * Returns the singleton instance
   * 
   * @return PropertyParser singleton instance
   */
  public static function singelton(string $delim = ':', string $sep = ';'): PropertyParser {
    $key = "$delim,$sep";
    if (!array_key_exists($key, self::$instance)) {
      self::$instance[$key] = new static($delim, $sep);
    }
    return self::$instance[$key];
  }

}
