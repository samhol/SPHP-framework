<?php

/**
 * StyleAttributeParser.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

/**
 * Description of StyleAttributeParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StyleAttributeFilter extends PropertyAttributeFilter {


  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string $properties properties to parse
   * @return string[] parsed property array containing name value pairs
   */
  public function filter($properties):array {
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
    return array_filter($parsed, function ($var) {
      return !empty($var) || $var === "0" || $var === 0;
    }, \ARRAY_FILTER_USE_BOTH);
  }

  public function isValid($value): bool {
      return !empty($value) || $value === "0" || $value === 0;
  }

}
