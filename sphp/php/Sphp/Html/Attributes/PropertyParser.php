<?php

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

  private $defSep = ';';
  private $propSep = ':';
  private $mutable = true;

  /**
   * Constructor
   * 
   * @param string $delim
   * @param string $sep
   * @throws BadMethodCallException
   */
  public function __construct(string $delim = ':', string $sep = ';') {
    if (false === $this->mutable) {
      throw new BadMethodCallException('Constructor called twice.');
    }
    $this->propSep = $delim;
    $this->defSep = $sep;
    $this->mutable = false;
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
      //$parsed = array_walk($properties, 'trim');
    } else if (is_string($properties)) {
      $parsed = $this->parseStringToProperties($properties);
    }
    foreach ($parsed as $property => $value) {
      if (!$this->isValidProperty($property, $value)) {
        throw new InvalidArgumentException("Property $property => $value is not valid ");
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
    return is_scalar($value) && $value !== '' && Strings::match($value, '/[^\s]+/');
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
   * 
   * @param string $properties
   * @return array
   * @throws InvalidArgumentException
   */
  public function parseStringToProperties(string $properties): array {
    $parsed = [];
    //$properties = Strings::trim($properties, $this->defSep);
    //var_dump($properties);
    $rows = explode($this->defSep, Strings::trim($properties, $this->defSep));
    if (empty($rows)) {
      $rows = [$properties];
    }
    //echo "rows:\n";
    //print_r($rows);
    foreach ($rows as $row) {
      $data = explode($this->propSep, $row);
      if (count($data) !== 2) {
        // echo "invalid data: \n";
        // print_r($data);
        throw new InvalidArgumentException("String '$properties' is not valid property string");
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

}
