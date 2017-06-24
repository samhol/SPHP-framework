<?php

/**
 * IdStorage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;

/**
 * Application Config class for storing common application data
 *
 * **Note:** Uses Singleton pattern
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdStorage {

  /**
   * @var self[]
   */
  private static $instances = [];

  /**
   * @var string[]
   */
  private $ids = [];

  /**
   * Constructs a new instance
   */
  protected function __construct() {
    
  }

  /**
   * 
   * @return IdStorage instance containing all identifiers of given name
   */
  public static function get(string $name): IdStorage {
    if (!array_key_exists($name, self::$instances)) {
      self::$instances[$name] = new static();
    }
    return self::$instances[$name];
  }

  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public static function isValidValue($value) {
    return is_string($value) && !preg_match('/[\r\n\r\n|\r\r|\n\n]/', $value);
  }

  /**
   * 
   * @param type $name
   */
  public function isValidIdentifyingName($name) {
    return Strings::match($name, "/^[a-zA-Z][\w:.-]*$/");
  }

  /**
   * Checks whether the storage contains identifier value
   *
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public function contains(string $value): bool {
    return in_array($value, $this->ids);
  }

  /**
   * Tries to store a new identifier value
   * 
   * @param  string $value the value of the identifier
   * @return boolean true if stored and `false` otherwise
   */
  public function store(string $value): bool {
    if (!$this->contains($value) && static::isValidValue($value)) {
      $this->ids[] = $value;
      return true;
    }
    return false;
  }

  /**
   * Generates and stores a random identifier
   * 
   * @param  string $prefix
   * @param  int $length 
   * @return string random identifier generated and stored by the storage
   */
  public function generateRandom(string $prefix = '', int $length = 16): string {
    $value = $prefix . Strings::random($length);
    while (!$this->store($value)) {
      $value = $prefix . Strings::random($length);
    }
    return $value;
  }

  /**
   * 
   * @return string[]
   */
  public function toArray(): array {
    return $this->ids;
  }

}
