<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use Iterator;
use Sphp\Config\PHP;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
use Sphp\Config\ErrorHandling\ErrorManager;

/**
 * Implements a bitmask object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @Embeddable
 */
class BitMask implements Arrayable, Iterator {

  private int $index = 0;

  /**
   * the binary value
   *
   * @var int
   * @Column(type = "integer")
   */
  protected int $mask;

  /**
   * Constructor
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
   * @param  int|string|BitMask $bitmask the flags to set
   * @return BitMask new instance
   */
  public function binAND(int|string|BitMask $bitmask): BitMask {
    return new static($this->mask & self::parseInt($bitmask));
  }

  /**
   * Logical `OR` (inclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param  int|string|BitMask $bitmask the other bitmask
   * @return BitMask new instance
   */
  public function binOR(int|string|BitMask $bitmask): BitMask {
    return new static($this->mask | self::parseInt($bitmask));
  }

  /**
   * Logical `XOR` (exclusive or) operation
   *
   * **IMPORTANT:** a string `$bitmask` is always treated as binary number
   *
   * @param int|string|BitMask $bitmask the flags to set
   * @return BitMask new instance
   */
  public function binXOR(int|string|BitMask $bitmask): BitMask {
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
  public function setBit(int $index): BitMask {
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
  public function getBit(int $index): int {
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
  public function unsetBit(int $index): BitMask {
    if (!$this->isValidIndex($index)) {
      throw new OutOfBoundsException("Index ($index) is not between (0-" . ($this->length() - 1) . ")");
    }
    return new static($this->mask &= ~(1 << $index));
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
   * @return bool true if the object contains given flags and false otherwise
   */
  public function contains(int|string|BitMask $bitmask): bool {
    $parsedFlags = self::parseInt($bitmask);
    return ($this->mask & $parsedFlags) === $parsedFlags;
  }

  /**
   * Returns the integer representation
   *
   * @return int integer representation
   */
  public function toInt(): int {
    return $this->mask;
  }

  /**
   * Returns the Octal string representation
   * 
   * @return string hexadecimal representation
   */
  public function toOct(): string {
    return decoct($this->mask);
  }

  /**
   * Returns the hexadecimal string representation
   * 
   * @return string hexadecimal representation
   */
  public function toHex(): string {
    return dechex($this->mask);
  }

  /**
   * Returns the Binary string representation
   * 
   * @return string Binary representation
   */
  public function toBin(): string {
    return decbin($this->mask);
  }

  /**
   * Returns the binary string representation
   *
   * @return string binary representation
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
      $result[$i] = $this->getBit($i);
    }
    return $result;
  }

  public function equals(mixed $object): bool {
    try {
      return $this->toInt() === static::parseInt($object);
    } catch (\Exception $ex) {
      return false;
    }
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind(): void {
    $this->index = 0;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current(): int {
    return $this->getBit($this->index);
  }

  /**
   * Return the key of the current element
   * 
   * @return int the key of the current element
   */
  public function key(): int {
    return $this->index;
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next(): void {
    $this->index++;
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current iterator position is valid
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
    return PHP::getBitVersion();
  }

  /**
   * Creates a new instance from binary input
   * 
   * @param  string $binary binary input
   * @return BitMask new instance
   * @throws InvalidArgumentException if the input is not valid binary string
   */
  public static function fromBinary(string $binary): BitMask {
    if (!Strings::typeIs($binary, Strings::TYPE_BINARY)) {
      throw new InvalidArgumentException('String given is not valid binary string');
    }
    return new static(bindec($binary));
  }

  /**
   * Creates a new instance from octal input
   *  
   * @param  string $octal octal input
   * @return BitMask new instance
   * @throws InvalidArgumentException if the input is not valid octal string
   */
  public static function fromOctal(string $octal): BitMask {
    if (!Strings::typeIs($octal, Strings::TYPE_OCTAL)) {
      throw new InvalidArgumentException('String given is not valid octal string');
    }
    return new static(octdec($octal));
  }

  /**
   * Creates a new instance from hexadecimal input
   * 
   * @param  string $hex hexadecimal input
   * @return BitMask new instance
   * @throws InvalidArgumentException if the input is not valid hexadecimal string
   */
  public static function fromHex(string $hex): BitMask {
    if (!Strings::typeIs($hex, Strings::TYPE_HEX)) {
      throw new InvalidArgumentException('String given is not valid hexadecimal string');
    }
    $v = str_replace(['#', '0x'], '', $hex);
    return new static(hexdec($v));
  }

  /**
   * Creates a new instance from input
   * 
   * @param  mixed $input
   * @return BitMask new instance
   * @throws InvalidArgumentException if the value given can not be parsed
   */
  public static function from(int|string|BitMask $input): BitMask {
    return new static(static::parseInt($input));
  }

  /**
   * Parses the given flags type to an integer
   * 
   * @param  int|string|BitMask $flags the flags
   * @return int parsed flags value
   * @throws InvalidArgumentException if the value given can not be parsed
   */
  public static function parseInt(int|string|BitMask $flags): int {
    if (is_string($flags)) {
      $obj = new MbString($flags);
      if ($obj->match('/^[1-9]{1,}(\d){0,}$/')) {
        return intval($flags);
      } else if ($obj->is(Strings::TYPE_BINARY)) {
        return bindec($flags);
      } else if ($obj->is(Strings::TYPE_OCTAL)) {
        return octdec($flags);
      } else if ($obj->is(Strings::TYPE_HEX)) {
        $flags = str_replace(['#', '0x'], '', $flags);
        return hexdec($flags);
      } else {
        throw new InvalidArgumentException("String value cannot be parsed to integer");
      }
    } else if ($flags instanceof BitMask) {
      $flags = $flags->toInt();
    }
    return $flags;
  }

}
