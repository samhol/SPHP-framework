<?php

/**
 * BitMask.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

use Sphp\Objects\ScalarObjectInterface;
use Sphp\Objects\EqualsTrait;
use Sphp\Data\Arrayable;

/**
 * Class models a bitmask object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BitMask implements ScalarObjectInterface, Arrayable {

  use EqualsTrait;

  /**
   * the binary value
   *
   * @var int
   */
  private $value = 0;

  /**
   * Constructs a new instance of the {@link self} object
   *
   * **Notes:** a string <var>$bits</var> is always trated as binary number
   * 
   * @param int|string|BitMask $bits the flags
   */
  public function __construct($bits = 0) {
    $this->value = self::parseFlagsToInt($bits);
  }

  /**
   * Logical `AND` operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return self for PHP Method Chaining
   */
  public function and_($bitmask) {
    $this->value = $this->value & self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Logical `OR` (inclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the other bitmask
   * @return self for PHP Method Chaining
   */
  public function or_($bitmask) {
    $this->value = $this->value | self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Logical `XOR` (exclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return self for PHP Method Chaining
   */
  public function xor_($bitmask) {
    $this->value = $this->value ^ self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Sets or unsets new bits at given index
   *
   * @param  int $index the specified index
   * @param  boolean $bit the bit value to set
   * @return self for PHP Method Chaining
   */
  public function set($index, $bit = true) {
    $value = intval(boolval($bit));
    if ($value === 0) {
      $this->value &= ~(1 << $index);
    } else {
      $this->value |= (1 << $index);
    }
    return $this;
  }

  /**
   * Returns the value of the bit with the specified index
   *
   * @param  int $index the specified index
   * @return int $bit the bit value to set
   */
  public function get($index) {
    return $this->value & (1 << $index);
  }

  /**
   * Sets new flags from 1 to 0
   *
   * **Notes:** a string <var>$bits</var> is always trated as binary number
   *
   * @param int|string|BitMask $bits the flags unset
   * @return self for PHP Method Chaining
   */
  public function clear($bits) {
    $this->value &= ~self::parseFlagsToInt($bits);
    return $this;
  }

  /**
   * Inverts the bits from 1 to 0 and vice versa
   *
   * @return self for PHP Method Chaining
   */
  public function invert() {
    $this->value = ~$this->value;
    return $this;
  }

  /**
   * Checks if the object contains given bits
   *
   * **Notes:** a string <var>$bits</var> is always trated as binary number
   *
   * @param int|string|BitMask $bitmask the flags
   * @return boolean true if the object contains given flags and false otherwise
   */
  public function contains($bitmask) {
    $parsedFlags = self::parseFlagsToInt($bitmask);
    //echo "\np=".$p."=".base_convert($p, 10, 2);
    //echo "\nthis->permissions=".$this->permissions."=".base_convert($this->permissions, 10, 2)."\n";
    return ($this->value & $parsedFlags) == $parsedFlags;
  }

  /**
   * Returns the current bitmask value as an integer
   *
   * @return int the current bitmask value as an integer
   */
  public function toInt() {
    return $this->value;
  }

  /**
   * Returns the Octal string representation of the bitmask
   * 
   * @return string the hexadecimal representation of the
   */
  public function toOct() {
    return decoct($this->value);
  }

  /**
   * Returns the hexadecimal string representation of the bitmask
   * 
   * @return string the hexadecimal representation of the
   */
  public function toHex() {
    return dechex($this->value);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString() {
    return decbin($this->value);
  }

  public function toArray() {
    return static::toBitArray($this->value);
  }
  
  public function toScalar() {
    return $this->value;
  }

  /**
   * Parses the given flas type to an integer
   * 
   * @param  int|string|BitMask $flags the flags
   * @return int parsed flags value
   */
  public static function parseFlagsToInt($flags) {
    if (!is_int($flags)) {
      if ($flags instanceof BitMask) {
        $flags = $flags->toInt();
      } else if (is_string($flags)) {
        $flags = bindec($flags);
      } else {
        $flags = intval($flags);
      }
    }
    return $flags;
  }

  /**
   * Parses the given flas type to an integer
   * 
   * @param  int|string|BitMask $flags the flags
   * @return int[] parsed flags value
   */
  public static function toBitArray($flags) {
    return str_split(decbin(self::parseFlagsToInt($flags)));
  }

}
