<?php

/**
 * StyleAttributeParser.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Filters;

/**
 * Description of StyleAttributeParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StyleAttributeParser implements AttributeDataParser {

  private static $instance;

  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string $properties properties to parse
   * @return string[] parsed property array containing name value pairs
   */
  public function parse($properties) {
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

  public static function instance(): StyleAttributeParser {
    if (static::$instance === null) {
      static::$instance = new static();
    }
    return static::$instance;
  }

  public function filter($rawData): array {
    
  }

  public function getErrors(): \Sphp\I18n\Collections\TranslatableCollection {
    
  }

  public function isValid($value): bool {
    
  }

}
