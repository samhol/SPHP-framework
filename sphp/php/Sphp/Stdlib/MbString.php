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

use Stringable;
use Countable;
use ArrayAccess;
use Iterator;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Implements a multibyte string class
 *    
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MbString implements Stringable, Countable, Iterator, Arrayable, ArrayAccess {

  protected int $index = 0;
  protected string $str;

  /**
   * The string's encoding, which should be one of the mbstring module's
   * supported encodings. 
   */
  protected string $encoding;

  /**
   * Constructor 
   * 
   * $str is cast to a string prior to assignment, and if
   * $encoding is not specified, it defaults to mb_internal_encoding().  
   *
   * @param  string $str the string value
   * @param  string|null $encoding the character encoding
   */
  public function __construct(string $str = '', ?string $encoding = null) {
    $this->str = $str;
    $this->encoding = $encoding ?: \mb_internal_encoding();
  }

  /**
   * Returns the string value of the object
   *
   * @return string the string value of the object
   */
  public function __toString(): string {
    return $this->str;
  }

  /**
   * Performs a regular expression match
   *
   * @param  string $pattern the pattern to search for, as a string
   * @return bool true if string matches to the regular expression, false otherwise
   */
  public function match(string $pattern): bool {
    //$regexEncoding = mb_regex_encoding();
    //echo "regexEncoding:($regexEncoding)\n";
    //\mb_regex_encoding(self::getEncoding($encoding));
    // $match = \mb_ereg_match($pattern, $string);
    // echo "regexEncodingNow:($regexEncoding)\n";
    //\mb_regex_encoding($regexEncoding);
    return preg_match($pattern, $this->str) === 1;
    // return $match === 1;
  }

  /**
   * Returns a string with whitespace removed from the start and end of the string 
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   * 
   * @param  string|null  $charMask optional string of characters to strip
   * @return MbString new trimmed instance  
   */
  public function trim(?string $charMask = null): MbString {
    $trimmed = Strings::trim($this->str, $charMask, $this->encoding);
    return new static($trimmed, $this->encoding);
  }

  /**
   * Returns a string with whitespace removed from the start of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   * 
   * @param  string|null $charMask optional string of characters to strip 
   * @return MbString new trimmed instance
   */
  public function trimLeft(?string $charMask = null): MbString {
    $trimmed = Strings::trimLeft($this->str, $charMask, $this->encoding);
    return new static($trimmed, $this->encoding);
  }

  /**
   * Returns a string with whitespace removed from the end of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   * 
   * @param  string  $charMask optional string of characters to strip 
   * @return MbString new trimmed instance
   */
  public function trimRight(?string $charMask = null): MbString {
    $trimmed = Strings::trimRight($this->str, $charMask, $this->encoding);
    return new static($trimmed, $this->encoding);
  }

  /**
   * Trims the string and replaces consecutive whitespace characters with a
   * single space
   * 
   * This includes tabs and newline characters, as well as multibyte whitespace 
   * such as the thin space and ideographic space.
   *  
   * @return MbString new trimmed instance
   */
  public function collapseWhitespace(): MbString {
    $collapsed = Strings::collapseWhitespace($this->str, $this->encoding);
    return new MbString($collapsed, $this->encoding);
  }

  public function contains(string $needle): bool {
    return str_contains($this->str, $needle);
  }

  /**
   * Checks whether the haystack string contains all $needles
   *
   * @param  string ... $needles Substrings to look for
   * @return bool whether or not the string contains $needle
   */
  public function containsAll(string ... $needles): bool {
    foreach ($needles as $needle) {
      if (!str_contains($this->str, (string) $needle)) {
        return false;
      }
    }
    return true;
  }

  /**
   * Checks whether the string contains any of the needles
   *
   * @param  string ... $needles Substrings to look for
   * @return bool whether the string contains any of the needles
   */
  public function containsAny(string ... $needles): bool {
    if (empty($needles)) {
      return true;
    }
    foreach ($needles as $needle) {
      if (str_contains($this->str, (string) $needle)) {
        return true;
      }
    }
    return false;
  }

  /**
   * Checks whether the string starts with the given needles
   *
   * @param  string $needle the start to compare with
   * @return bool true if the string starts with the given needles
   */
  public function startsWith(string $needle): bool {
    return str_starts_with($this->str, $needle);
  }

  /**
   * Checks whether the string ends with the given needles
   *
   * @param  string $needle the end to compare with
   * @return bool true if the string ends with the given needles
   */
  public function endsWith(string $needle): bool {
    return str_ends_with($this->str, $needle);
  }

  /**
   * Returns the number of occurrences of $substring in the string
   * 
   * By default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $substring the substring to search for
   * @param  bool $caseSensitive Whether or not to enforce case-sensitivity
   * @return int The number of $substring occurrences
   */
  public function countSubstr(string $substring, bool $caseSensitive = true): int {
    if (!$caseSensitive) {
      $string = \mb_strtoupper($this->str, $this->encoding);
      $substring = \mb_strtoupper($substring, $this->encoding);
    } else {
      $string = $this->str;
    }
    return \mb_substr_count($string, $substring, $this->encoding);
  }

  /**
   * Perform a case folding
   * 
   * @param  int $mode the mode of the conversion. It can be one of `MB_CASE_UPPER`, `MB_CASE_LOWER`, or `MB_CASE_TITLE`. 
   * @return MbString new case folded version instance of string converted in the way specified by mode
   */
  public function convertCase(int $mode): MbString {
    $str = \mb_convert_case($this->str, $mode, $this->encoding);
    return new static($str, $this->encoding);
  }

  public function is(string|int $type): bool {
    return Strings::typeIs($this->str, $type);
  }

  /**
   * Checks whether the string is empty
   * 
   * @return bool true if the string is empty, false otherwise
   */
  public function isEmpty(): bool {
    return $this->str === '';
  }

  /**
   * Returns the length of the string
   *
   * @return int the length of the string
   */
  public function count(): int {
    return mb_strlen($this->str, $this->encoding);
  }

  /**
   * Perform a regular expression search and replace
   *
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $replacement the replacement text
   * @param  int $limit
   * @return MMbString new instance
   */
  public function pregReplace(string $pattern, string $replacement, int $limit = -1, int &$count = null): MbString {
    $result = preg_replace($pattern, $replacement, $this->str, $limit, $count);
    return new static($result, $this->encoding);
  }

  /**
   * Replaces a regular expression with multibyte support
   *
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $replacement the replacement text.
   * @param  string $option
   * @return string|boolean the resultant string on success, or false on error
   * @link   https://www.php.net/manual/en/function.mb-ereg-replace.php
   */
  public function eregReplace(string $pattern, string $replacement, $option = null): MbString {
    $regexEncoding = mb_regex_encoding();
    mb_regex_encoding($this->encoding);
    if ($option === null) {
      $option = 'msr';
    }
    $result = \mb_ereg_replace($pattern, $replacement, $this->str, $option);
    mb_regex_encoding($regexEncoding);
    return new static($result, $this->encoding);
  }

  /**
   * Replaces all occurrences of $search in $str by $replacement
   *  
   * @param  string|array $search
   * @param  string|array $replacement The string to replace with
   * @return MbString new instance with the replacements
   */
  public function replace(string|array $search, string|array $replacement): MbString {
    $str = str_replace($search, $replacement, $this->str);
    return new static($str, $this->encoding);
  }

  /**
   * Returns a new instance with reversed string
   * 
   * @return MbString new Revered instance
   */
  public function reverse(): MbString {
    $reversed = Strings::reverse($this->str, $this->encoding);
    return new static($reversed, $this->encoding);
  }

  /**
   * Returns the index of the first occurrence of $needle in the string
   * 
   * Returns null if the needle was not found. Accepts an optional offset from 
   * which to begin the search.
   *
   * @param  string $needle Substring to look for
   * @param  int $offset Offset from which to search
   * @return int|null The occurrence's index if found, otherwise null
   */
  public function strpos(string $needle, int $offset = 0): ?int {
    $pos = \mb_strpos($this->str, $needle, $offset, $this->encoding);
    return $pos === false ? null : $pos;
  }

  /**
   * Returns the character at $index, with indexes starting at 0
   *
   * @param  int $index position of the character
   * @return string the character at $index or null if the index does not exist
   * @throws OutOfBoundsException if the index does not exist
   */
  public function charAt(int $index): string {
    $length = $this->count();
    if ($index < 0 || $length - 1 < $index) {
      throw new OutOfBoundsException("No character exists at the index: ($index)");
    }
    return \mb_substr($this->str, $index, 1, $this->encoding);
  }

  /**
   * Returns an array consisting of the characters in the string
   *
   * @return string[] An array of individual chars
   */
  public function toArray(): array {
    return Strings::toArray($this->str, $this->encoding);
  }

  /**
   * Returns the encoding used
   *
   * @return string the encoding used
   */
  public function getEncoding(): string {
    return $this->encoding;
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    $this->index = 0;
  }

  /**
   * Returns the current character
   * 
   * @return mixed the current character
   */
  public function current(): string {
    return $this->charAt($this->index);
  }

  /**
   * Return the key of the current character
   * 
   * @return int the key of the current character
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
   * @return bool current iterator position is valid
   */
  public function valid(): bool {
    return $this->index < $this->count();
  }

  /**
   * Checks whether a character exists in the query
   * 
   * @param  mixed $offset the name of the parameter
   * @return bool true if the parameter exists and false otherwise
   */
  public function offsetExists(mixed $offset): bool {
    $out = false;
    if (is_numeric($offset)) {
      $intOffset = (int) $offset;
      $out = $intOffset >= 0 && $intOffset < $this->count();
    }
    return $out;
  }

  /**
   * Returns the character at the given index
   * 
   * @param  mixed $offset
   * @return string character at the given index 
   * @throws OutOfBoundsException if the offset does not exist
   * @throws InvalidArgumentException
   */
  public function offsetGet(mixed $offset): string {
    if (!$this->offsetExists($offset)) {
      throw new OutOfBoundsException('Offset must be between 0 and ' . ($this->count() - 1));
    }
    return $this->charAt((int) $offset);
  }

  /**
   * Sets the character at given $offset 
   * 
   * @param  mixed $offset
   * @param  mixed $value
   * @return void
   * @throws InvalidArgumentException if the value is not exactly one character
   * @throws OutOfBoundsException if the offset is invalid
   */
  public function offsetSet(mixed $offset, mixed $value): void {
    if ($offset === null) {
      $offset = $this->count();
    }
    if ($this->offsetExists($offset) || $offset === $this->count()) {
      $strVal = (string) $value;
      $strLength = mb_strlen($strVal, $this->encoding);
      if ($strLength !== 1) {
        throw new InvalidArgumentException('Value must be exactly one char');
      }
      $this->str = Strings::substringReplace($this->str, $strVal, (int) $offset, 1, $this->encoding);
    } else {
      throw new OutOfBoundsException('String offset must be between 0 and ' . $this->count() . ' or null ' . $offset . ' given');
    }
  }

  /**
   * Unsets the character at the given index
   * 
   * @param  mixed $offset
   * @return void
   * @throws InvalidArgumentException
   * @throws OutOfBoundsException
   */
  public function offsetUnset(mixed $offset): void {
    if (!$this->offsetExists($offset)) {
      throw new OutOfBoundsException('Offset must be between 0 and ' . ($this->count() - 1) . '');
    }
    $this->str = substr_replace($this->str, '', $offset, 1);
  }

  /**
   * Creates a string object from given str and encoding properties
   * 
   * If $encoding is not specified, it defaults to mb_internal_encoding(). It
   * then returns the initialized object.
   *
   * @param  Stringable|int|float|string|null   $str      Value to modify, after being cast to string
   * @param  string  $encoding The character encoding
   * @return self an instance 
   */
  public static function create(Stringable|int|float|string|null $str = null, ?string $encoding = null): MbString {
    return new static("$str", $encoding);
  }

}
