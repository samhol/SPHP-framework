<?php

/**
 * BitMask.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use Iterator;
use Sphp\Config\PHPConfig;
use Sphp\Database\Doctrine\Embeddable;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\OutOfBoundsException;

/**
 * Implements a bitmask object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-15
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Embeddable
 */
class BitMask implements Arrayable, Embeddable, Iterator {

  /**
   * @var int 
   */
  private $index = 0;

  /**
   * the binary value
   *
   * @var int
   * @Column(type = "integer")
   */
  protected $mask;

  /**
   * Constructs a new instance
   *
   * **Notes:** a string <var>$bits</var> is always treated as binary number
   * 
   * @param int $bits the flags
   */
  public function __construct(int $bits = 0b0) {
    $this->mask = $bits;
  }

  /**
   * Logical `AND` operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return $this for a fluent interface
   */
  public function binAND($bitmask) {
    return new static($this->mask & self::parseInt($bitmask));
  }

  /**
   * Logical `OR` (inclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the other bitmask
   * @return $this for a fluent interface
   */
  public function binOR($bitmask) {
    return new static($this->mask | self::parseInt($bitmask));
  }

  /**
   * Logical `XOR` (exclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return $this for a fluent interface
   */
  public function binXOR($bitmask) {
    return new static($this->mask ^ self::parseInt($bitmask));
  }

  protected function isValidIndex($index): bool {
    return 0 <= $index && $index < $this->length();
  }

  /**
   * Sets new bits at given index
   *
   * The bit at he given index is set to `1`
   * 
   * @param  int $index the specified index
   * @return BitMask new instance
   * @throws OutOfBoundsException if the given index is not valid
   */
  public function set(int $index): BitMask {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not between (0-" . ($this->length() - 1) . ")");
    }
    return new static($this->mask |= (1 << $index));
  }

  /**
   * Returns the value of the bit with the specified index
   *
   * @param  int $index the specified index
   * @return int the value of the bit with the specified index
   * @throws OutOfBoundsException if the given index is not valid
   */
  public function get(int $index): int {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not between (0-" . ($this->length() - 1) . ")");
    }
    return ($this->mask >> $index) & 1;
  }

  /**
   * Unsets a bit at a given index
   *
   * The bit at he given index is set to `0`
   * 
   * @param  int $index the specified index
   * @return BitMask new instance
   * @throws OutOfBoundsException if the given index is not valid
   */
  public function unset(int $index): BitMask {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not between (0-" . ($this->length() - 1) . ")");
    }
    return new static($this->mask &= ~(1 << $index));
  }

  /**
   * Sets new flags from 1 to 0
   *
   * **Notes:** a string <var>$bits</var> is always trated as binary number
   *
   * @param int|string|BitMask $bits the flags unset
   * @return BitMask new instance
   */
  public function clear(int $bits): BitMask {
    return new static($this->mask &= ~$bits);
  }

  /**
   * Inverts the bits from 1 to 0 and vice versa
   *
   * @return BitMask new inverted instance
   */
  public function invert(): BitMask {
    return new static(~$this->mask);
  }

  /**
   * Checks if the object contains given bits
   *
   * **Notes:** a string <var>$bits</var> is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags
   * @return boolean true if the object contains given flags and false otherwise
   */
  public function contains($bitmask): bool {
    $parsedFlags = self::parseInt($bitmask);
    //echo "\np=".$p."=".base_convert($p, 10, 2);
    //echo "\nthis->permissions=".$this->permissions."=".base_convert($this->permissions, 10, 2)."\n";
    return ($this->mask & $parsedFlags) === $parsedFlags;
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
  public function toOct(): string {
    return decoct($this->mask);
  }

  /**
   * Returns the hexadecimal string representation of the bitmask
   * 
   * @return string the hexadecimal representation
   */
  public function toHex(): string {
    return dechex($this->mask);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function binaryRepresentation(): string {
    return str_pad("$this", $this->length(), '0', STR_PAD_LEFT);
  }

  /**
   * Returns the object as a string
   *
   * @return string the object as a string
   */
  public function __toString(): string {
    return decbin($this->mask);
  }

  public function toArray(): array {
    $result = [];
    for ($i = 0; $i < $this->length(); $i++) {
      $result[$i] = $this->get($i);
    }
    return $result;
  }

  /**
   * Parses the given flags type to an integer
   * 
   * @param  int|string|BitMask $flags the flags
   * @return int parsed flags value
   * @throws InvalidArgumentException if the value given can not be parsed
   */
  public static function parseInt($flags): int {
    if (!is_int($flags)) {
      if (is_string($flags)) {
        $obj = new MbString($flags);
        if ($obj->startsWith('#') || $obj->startsWith('0x')) {
          $flags = str_replace(['#', '0x'], '', $flags);
          return hexdec($flags);
        } else {
          $flags = intval($flags);
        }
      } else if (is_scalar($flags)) {
        $flags = intval($flags);
      } else if ($flags instanceof BitMask) {
        $flags = $flags->toInt();
      } else {
        throw new InvalidArgumentException("Value cannot be parsed to integer");
      }
    }
    return $flags;
  }

  public function equals($object): bool {
    try {
      return $this->toInt() === static::parseInt($object);
    } catch (\Exception $ex) {
      return false;
    }
  }

  public static function fromString(string $value) {
    $v = str_replace(['#', '0x'], '', $hex);
    $obj = new MbString($value);
    if ($obj->startsWith('#') || $obj->startsWith('0x')) {
      return static::fromHex($value);
    }
    return new static(hexdec($v));
  }

  /**
   * 
   * @param  string $binary
   * @return BitMask
   */
  public static function fromBinary(string $binary): BitMask {
    return new static(bindec($binary));
  }

  /**
   * 
   * @param  string $octal
   * @return BitMask
   */
  public static function fromOctal(string $octal): BitMask {
    return new static(octdec($octal));
  }

  /**
   * 
   * @param  string $hex
   * @return BitMask
   */
  public static function fromHex(string $hex): BitMask {
    $v = str_replace(['#', '0x'], '', $hex);
    return new static(hexdec($v));
  }

  /**
   * 
   * @param  mixed $hex
   * @return BitMask
   */
  public function from($hex): BitMask {
    return new static(static::parseInt($hex));
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    $this->index = 0;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current(): int {
    return $this->get($this->index);
  }

  /**
   * Return the key of the current element
   * 
   * @return int the key of the current element
   */
  public function key(): int {
    return $this->index;
  }

  public function next() {
    $this->index++;
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return $this->index < $this->length();
  }

  /**
   * Returns the (maximum) length of the bitmask
   * 
   * @return int the (maximum) length of the bitmask
   */
  public function length(): int {
    return PHPConfig::getBitVersion();
  }

}
