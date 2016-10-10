<?php

/**
 * HtmlIdStorage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Core\Types\Strings;

/**
 * Application Config class for storing common application data
 *
 * **Note:** Uses Singleton pattern
 *
 * Stored variable names can either be an `integer` or a `string`.
 * Additionally the following <var>$varName</var> casting is equal with the
 * PHP array key casting. The <var>$value</var> can be of any type.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HtmlIdStorage {

  /**
   *
   * @var string[]
   */
  private static $ids = [];

  /**
   * Singelton constructor for the {@link self} object
   * 
   * @param  string $domain the domain name of the instance
   */
  private function __construct() {
    
  }

  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public static function isValidValue($value) {
    return is_string($value) && !preg_match('/[\r\n\r\n|\r\r|\n\n]/',$value);
  }

  /**
   * 
   * @param type $name
   */
  public static function isValidIdentifyingName($name) {
    return Strings::match($name, "/^[a-zA-Z][\w:.-]*$/");
  }

  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public static function exists($name, $value) {
    return array_key_exists($name, self::$ids) && in_array($value, self::$ids[$name]);
  }

  /**
   * Tries to store a new identifier name value pair
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean `true` if stored and `false` otherwise
   */
  public static function store($name, $value) {
    $inserted = false;
    if (!static::exists($name, $value) && static::isValidIdentifyingName($name) && static::isValidValue($value)) {
      if (!array_key_exists($name, self::$ids)) {
        self::$ids[$name] = [];
      }
      self::$ids[$name][] = $value;
      $inserted = true;
    }
    return (bool)$inserted;
  }

  /**
   * 
   * @return string[]
   */
  public static function toArray() {
    return self::$ids;
  }

}
