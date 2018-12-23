<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;

/**
 * Implements a storage for HTML id attribute values
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
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
   * Constructor
   */
  private function __construct() {
    
  }

  /**
   * Returns storage instance containing ids for definite attribute name
   * 
   * @param  string $name the name of the storage
   * @return IdStorage singleton instance of storage for identifiers of given name  
   */
  public static function get(string $name): IdStorage {
    if (!isset(self::$instances[$name])) {
      static::$instances[$name] = new static();
    }
    return static::$instances[$name];
  }

  /**
   * Checks whether the storage contains identifier value
   *
   * @param  string $value the value of the identifier
   * @return boolean true on success or false on failure
   */
  public function getOwner(string $value): bool {
    if ($this->contains($value)) {
      return $this->ids[$value];
    }
    return null;
  }

  /**
   * Checks whether the storage contains identifier value
   *
   * @param  string $value the value of the identifier
   * @param string $for
   * @return boolean true on success or false on failure
   */
  public function contains(string $value, $for = null): bool {
    if ($for === null) {
      $for = $value;
    }
    return isset($this->ids[$value]) && $this->ids[$value] === $for;
  }

  /**
   * Tries to store a new identifier value
   * 
   * @param  string $value the value of the identifier
   * @param  string $for
   * @return boolean true if stored and `false` otherwise
   */
  public function store(string $value, $for = null): bool {
    if ($for === null) {
      $for = $value;
    }
    if (!$this->contains($value)) {
      $this->ids[$value] = $for;
      return true;
    }
    //print_r($this->ids);
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
    $allChars = "0123456789$letters";
    $first = Strings::randomize($letters, 1);
    $value = $first . Strings::randomize($allChars, $length - 1);
    while (!$this->store($value)) {
      $value = $first . Strings::randomize($allChars, $length - 1);
    }
    return $value;
  }

}
