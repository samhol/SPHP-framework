<?php

/**
 * PropertyAttributeUtils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

/**
 * Utilities for validating and filtering property attributes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PropertyAttributeUtils {

  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string|scalar[] $properties properties to parse
   * @return scalar[] parsed property array containing name value pairs
   */
  public function parse($properties): array {
    $parsed = [];
    if (is_array($properties)) {
      $parsed = $properties;
    } else if (is_string($properties)) {
      $rows = explode(';', $properties);
      if (empty($rows)) {
        $rows = [$properties];
      }
      foreach ($rows as $row) {
        $data = explode(':', $row, 2);
        if (count($data) === 2) {
          $parsed[trim($data[0])] = trim($data[1]);
        }
      }
    }
    return array_filter($parsed, function ($value, $prop) {
      return $this->isValidValue($value) && $this->isValidPropertyName($prop);
    }, \ARRAY_FILTER_USE_BOTH);
  }

  /**
   * Validates a given property name 
   * 
   * @param  mixed $name the name of the property
   * @return boolean true if the property name is valid
   */
  public function isValidPropertyName($name): bool {
    return is_string($name) && !empty($name) || $name === '0' || $name === 0;
  }

  /**
   * Validates a given value
   * 
   * @param  mixed $value the value of the property
   * @return boolean true if the property value is valid
   */
  public function isValidValue($value): bool {
    return is_scalar($value) && (!empty($value) || $value === '0' || $value === 0);
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

  public function parseStringToArray(string $properties): array {
    $parsed = [];
    $rows = explode(';', $properties);
    if (empty($rows)) {
      $rows = [$properties];
    }
    foreach ($rows as $row) {
      $data = explode(':', $row, 2);
      if (count($data) === 2) {
        $parsed[trim($data[0])] = trim($data[1]);
      }
    }
    return $result;
  }

}
