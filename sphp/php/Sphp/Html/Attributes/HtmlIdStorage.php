<?php

/**
 * HtmlIdStorage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

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
  private $ids = [];
  
  /**
   * the singelton instance
   *
   * @var HtmlIdStorage
   */
  private static $instance;

  /**
   * Singelton constructor for the {@link self} object
   * 
   * @param  string $domain the domain name of the instance
   */
  protected function __construct() {
    $this->ids = [];
  }

  /**
   * Returns the configurator instance paired with the current domain
   *
   * @return self the configurator instance paired with the current domain
   */
  public static function get() {
    if (static::$instance === null) {
      static::$instance = new static();
    }
    return static::$instance;
  }
  
  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public function isValidValue($value) {
   return is_string($value) && !\Sphp\Core\Types\Strings::isEmpty($value);
  } 


  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public function exists($name, $value) {
   return array_key_exists($name, $this->ids) && in_array($value, $this->ids[$name]);
  } 
  

  /**
   * Tries to store a new identifier name value pair
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true 
   */
  public function store($name, $value) {
    $inserted = false;
    if (!array_key_exists($name, $this->ids)) {
      $this->ids[$name] = [];
    }
    if (!in_array($value, $this->ids[$name]) && $this->isValidValue($value)) {
      $this->ids[$name][] = $value;
      $inserted = true;
    }
    return $inserted;
  }

}
