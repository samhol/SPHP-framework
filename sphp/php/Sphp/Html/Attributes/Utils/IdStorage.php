<?php

/**
 * IdStorage.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Sphp\Stdlib\Strings;

/**
 * Implements a storage for HTML ids
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
  private function __construct() {
    
  }

  /**
   * 
   * @param  string $name the name of the storage
   * @return IdStorage instance
   */
  public static function get(string $name): IdStorage {
    if (!isset(self::$instances[$name])) {
      static::$instances[$name] = new static();
    }
    return static::$instances[$name];
  }

  /**
   * Checks whether the identifier name value pair exists
   *
   * @param  string $name the name of the identifier
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public static function isValidValue($value): bool {
    return is_string($value) && !preg_match('/[\r\n\r\n|\r\r|\n\n]/', $value);
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
    print_r($this->ids);
    return false;
  }

  /**
   * Generates and stores a random identifier
   * 
   * @param  int $length the string length of the identifier
   * @return string random identifier generated and stored by the storage
   */
  public function generateRandom(int $length = 16): string {
    $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $allChars = "0123456789-.$letters";
    $first = Strings::randomize($letters, 1);
    $value = $first . Strings::randomize($allChars, $length - 1);
    while (!$this->store($value)) {
      $value = $first . Strings::randomize($allChars, $length - 1);
    }
    return $value;
  }

}
