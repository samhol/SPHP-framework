<?php

/**
 * BitMask.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Db\Objects\Embeddable;

/**
 * Implements a bitmask object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class BitMask implements Arrayable, Embeddable {

  /**
   * the binary value
   *
   * @var int
   * @Column(type = "integer")
   */
  protected $mask = 0;

  /**
   * Constructs a new instance of the {@link self} object
   *
   * **Notes:** a string <var>$bits</var> is always treated as binary number
   * 
   * @param int|string|BitMask $bits the flags
   */
  public function __construct($bits = 0) {
    $this->mask = self::parseFlagsToInt($bits);
  }

  /**
   * Logical `AND` operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return self for a fluent interface
   */
  public function and_($bitmask) {
    $this->mask = $this->mask & self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Logical `OR` (inclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the other bitmask
   * @return self for a fluent interface
   */
  public function or_($bitmask) {
    $this->mask = $this->mask | self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Logical `XOR` (exclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return self for a fluent interface
   */
  public function xor_($bitmask) {
    $this->mask = $this->mask ^ self::parseFlagsToInt($bitmask);
    return $this;
  }

  /**
   * Sets or unsets new bits at given index
   *
   * @param  int $index the specified index
   * @param  boolean $bit the bit value to set
   * @return self for a fluent interface
   */
  public function set(int $index, bool $bit = true) {
    $value = intval(boolval($bit));
    if ($value === 0) {
      $this->mask &= ~(1 << $index);
    } else {
      $this->mask |= (1 << $index);
    }
    return $this;
  }

  /**
   * Returns the value of the bit with the specified index
   *
   * @param  int $index the specified index
   * @return int the value of the bit with the specified index
   */
  public function get(int $index) {
    return $this->mask & (1 << $index);
  }

  /**
   * Sets new flags from 1 to 0
   *
   * **Notes:** a string <var>$bits</var> is always trated as binary number
   *
   * @param int|string|BitMask $bits the flags unset
   * @return self for a fluent interface
   */
  public function clear($bits) {
    $this->mask &= ~self::parseFlagsToInt($bits);
    return $this;
  }

  /**
   * Inverts the bits from 1 to 0 and vice versa
   *
   * @return self for a fluent interface
   */
  public function invert() {
    $this->mask = ~$this->mask;
    return $this;
  }

  /**
   * Checks if the object contains given bits
   *
   * **Notes:** a string <var>$bits</var> is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags
   * @return boolean true if the object contains given flags and false otherwise
   */
  public function contains($bitmask) {
    $parsedFlags = self::parseFlagsToInt($bitmask);
    //echo "\np=".$p."=".base_convert($p, 10, 2);
    //echo "\nthis->permissions=".$this->permissions."=".base_convert($this->permissions, 10, 2)."\n";
    return ($this->mask & $parsedFlags) == $parsedFlags;
  }

  /**
   * Returns the current bitmask value as an integer
   *
   * @return int the current bitmask value as an integer
   */
  public function toInt(): int {
    return $this->mask;
  }

  /**
   * Returns the Octal string representation of the bitmask
   * 
   * @return string the hexadecimal representation of the
   */
  public function toOct() {
    return decoct($this->mask);
  }

  /**
   * Returns the hexadecimal string representation of the bitmask
   * 
   * @return string the hexadecimal representation of the
   */
  public function toHex() {
    return dechex($this->mask);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string {
    return decbin($this->mask);
  }

  /**
   * {@inheritdoc}
   */
  public function toArray(): array {
    return static::toBitArray($this->mask);
  }

  public function toScalar() {
    return $this->mask;
  }

  /**
   * Parses the given flags type to an integer
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
   * Parses the given flags type to an integer
   * 
   * @param  int|string|BitMask $flags the flags
   * @return int[] parsed flags value
   */
  public static function toBitArray($flags) {
    return str_split(decbin(self::parseFlagsToInt($flags)));
  }

  public function equals($object) {
    if (!$object instanceof BitMask) {
      return $this->toInt() === static::parseFlagsToInt($object);
    } else {
      return $object == $this;
    }
  }

}
