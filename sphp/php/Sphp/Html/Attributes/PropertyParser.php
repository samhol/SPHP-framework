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

use Sphp\Exceptions\BadMethodCallException;
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

  /**
   * @var PropertyParser
   */
  private static $instance;

  /**
   * @var string 
   */
  private $defSep = ';';

  /**
   * @var string 
   */
  private $propSep = ':';

  /**
   * @var boolean 
   */
  private $isInstantiated = false;

  /**
   * Constructor
   * 
   * @param  string $delim
   * @param  string $sep
   * @throws BadMethodCallException
   * @throws InvalidArgumentException
   */
  public function __construct(string $delim = ':', string $sep = ';') {
    if (true === $this->isInstantiated) {
      throw new BadMethodCallException('Constructor called twice');
    }
    if ($delim === '' || $sep === '') {
      throw new InvalidArgumentException('Either Delimeter or separator cannot be empty');
    }
    if ($delim === $sep) {
      throw new InvalidArgumentException('Delimeter and separator cannot be the same');
    }
    $this->propSep = $delim;
    $this->defSep = $sep;
    $this->isInstantiated = true;
  }

  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string|array $properties properties to parse
   * @return scalar[] parsed property array containing name value pairs
   */
  public function parse($properties): array {
    $parsed = [];
    if (is_array($properties)) {
      $parsed = $properties;
    } else if (is_string($properties)) {
      $parsed = $this->parseStringToProperties($properties);
    }
    foreach ($parsed as $property => $value) {
      if (!$this->isValidProperty($property, $value)) {
        throw new AttributeException("Property '$property' is not valid");
      }
    }
    return $parsed;
  }

  /**
   * Validates a given property name 
   * 
   * @param  mixed $name the name of the property
   * @return boolean true if the property name is valid
   */
  public function isValidPropertyName($name): bool {
    return is_string($name) && $name !== '' && Strings::match($name, '/[^\s]+/');
  }

  /**
   * Validates a given value
   * 
   * @param  mixed $value the value of the property
   * @return boolean true if the property value is valid
   */
  public function isValidValue($value): bool {
    return is_scalar($value) && $value !== '' && Strings::match((string) $value, '/[^\s]+/');
  }

  /**
   * Validates a given property name => value pair 
   * 
   * @param  mixed $name the name of the property
   * @param  mixed $value the value of the property
   * @return boolean true if the property name => value pair is valid
   */
  public function isValidProperty($name, $value): bool {
    return $this->isValidValue($value) && $this->isValidPropertyName($name);
  }

  /**
   * PArses a property string to an array containing propertyname => value pairs
   * 
   * @param  string $properties
   * @return array
   * @throws InvalidArgumentException
   */
  public function parseStringToProperties(string $properties): array {
    $parsed = [];
    $rows = explode($this->defSep, Strings::trim($properties, $this->defSep));
    foreach ($rows as $row) {
      $data = explode($this->propSep, $row);
      if (count($data) !== 2) {
        throw new AttributeException("String '$properties' is not valid property string");
      }
      if (!$this->isValidProperty($data[0], $data[1])) {
        throw new AttributeException("Property $data[0] => $data[1] is not valid ");
      }
      $parsed[trim($data[0])] = trim($data[1]);
    }
    return $parsed;
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
    $strings = [];
    foreach ($props as $name => $value) {
      $strings[] = $this->propertyToString($name, $value);
    }
    $output = implode($this->defSep, $strings) . $this->defSep;
    return $output;
  }

  /**
   * Returns the singleton instance
   * 
   * @return PropertyParser singleton instance
   */
  public static function instance(): PropertyParser {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
