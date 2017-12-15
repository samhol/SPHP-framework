<?php

/**
 * MbString.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Countable;
use ArrayAccess;
use Iterator;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Implements a string class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MbString implements Countable, Iterator, Arrayable, ArrayAccess {

  /**
   * @var int
   */
  private $index = 0;

  /**
   * An instance string
   *
   * @var string
   */
  private $str;

  /**
   * The string's encoding, which should be one of the mbstring module's
   * supported encodings.
   *
   * @var string
   */
  private $encoding;

  /**
   * Constructs a new instance 
   * 
   * $str is cast to a string prior to assignment, and if
   * $encoding is not specified, it defaults to mb_internal_encoding(). Throws
   * an InvalidArgumentException if the first argument is an array or object
   * without a __toString method.
   *
   * @param  string $str Value to modify, after being cast to string
   * @param  string $encoding The character encoding
   */
  public function __construct(string $str = '', string $encoding = null) {
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
   * @return boolean true if string matches to the regular expression, false otherwise
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
   * Creates a string object from given str and encoding properties
   * 
   * If $encoding is not specified, it defaults to mb_internal_encoding(). It
   * then returns the initialized object.
   *
   * @param  mixed   $str      Value to modify, after being cast to string
   * @param  string  $encoding The character encoding
   * @return self an instance
   * @throws \Sphp\Exceptions\InvalidArgumentException if an array or object without a
   *         __toString method is passed as the first argument
   */
  public static function create($str = '', string $encoding = null): MbString {
    return new static("$str", $encoding);
  }

  /**
   * Checks whether the string is empty
   * 
   * @return boolean true if the string is empty, false otherwise
   */
  public function isEmpty(): bool {
    return $this->str === '';
  }

  /**
   * Returns the length of the given string
   * 
   * @return int the length of the given string
   */
  public function length(): int {
    return \mb_strlen($this->str, $this->encoding);
  }

  /**
   * Returns the length of the string
   *
   * @return int the length of the string
   */
  public function count(): int {
    return $this->length();
  }

  /**
   * Checks whether the string starts with a given needle
   *
   * @param  string $needle the start to compare with
   * @return boolean true if the string starts with any of the given needles
   */
  public function startsWith(string $needle): bool {
    return $needle === '' || mb_strrpos($this->str, $needle, 0, $this->encoding) === 0;
  }

  /**
   * Checks whether the string ends with a given needle
   *
   * @param  string $needle the ending to compare with
   * @return boolean true if the haystack ends with any of the given needles
   */
  public function endsWith(string $needle): bool {
    if ($needle === '') {
      return true;
    } else {
      $length = \mb_strlen($needle, $this->encoding);
      return \mb_substr($this->str, -$length, $length, $this->encoding) === $needle;
    }
  }

  /**
   * Checks whether the string contains any of the needles
   *
   * @return bool whether the string contains any of the needles
   */
  public static function containsAny(array $needles): bool {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if ($this->contains((string) $needle)) {
          return true;
        }
      }
      return false;
    }
  }

  /**
   * Checks whether the string contains all needles
   *
   * @param  array $needles
   * @return bool whether the string contains all needles
   */
  public static function containsAll(array $needles): bool {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if (!$this->contains((string) $needle)) {
          return false;
        }
      }
      return true;
    }
  }

  /**
   * Tests whether the string object contains the substring or not
   *
   * @param  string $needle the substring to search for
   * @return boolean true if needle was found from the haystack string, false otherwise
   */
  public function contains(string $needle): bool {
    return (mb_stripos($this->str, $needle, 0, $this->encoding) !== false);
  }

  /**
   * Replaces a regular expression with multibyte support
   *
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $replacement the replacement text.
   * @param  string $option
   * @return string|boolean the resultant string on success, or false on error
   * @link   http://php.net/manual/en/function.mb-ereg-replace.php
   */
  public function regexReplace(string $pattern, string $replacement, $option = null): MbString {
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
   * @param  string $replacement The string to replace with
   * @return MbString the resulting string after the replacements
   */
  public function replace(string $search, string $replacement): MbString {
    return $this->regexReplace(preg_quote($search), $replacement);
  }

  /**
   * Returns a new object with whitespace removed from the start and end of the string 
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @return MbString new trimmed string object 
   */
  public function trim(string $charMask = null): MbString {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return $this->regexReplace("^[$chars]+|[$chars]+$", '', 'msr');
  }

  /**
   * Returns a string with whitespace removed from the start of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string  $charMask optional string of characters to strip
   * @return MbString new trimmed string object 
   */
  public function trimLeft(string $charMask = null): MbString {
    $chars = ($charMask !== null) ? preg_quote($charMask) : '[:space:]';
    return $this->regexReplace("^[$chars]+", '', 'msr');
  }

  /**
   * Returns a string with whitespace removed from the end of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string  $charMask optional string of characters to strip
   * @return MbString new trimmed string object 
   */
  public function trimRight(string $charMask = null): MbString {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return $this->regexReplace("[$chars]+$", '', 'msr');
  }

  /**
   * Checks whether or not the string contains only upper case characters
   *
   * @return bool returns true if the string contains only upper chars, false otherwise
   */
  public function isUpperCase(): bool {
    return \mb_strtoupper($this->str, $this->encoding) === $this->str;
  }

  /**
   * Converts all characters in the string to uppercase
   *
   * @return MbString new string object with all characters being uppercase
   */
  public function toUpperCase(): MbString {
    $upper = \mb_strtoupper($this->str, $this->encoding);
    return new static($upper, $this->encoding);
  }

  /**
   * Checks whether or not the input string contains only lower case characters
   *
   * @return bool returns true if the string contains only lower chars, false otherwise
   */
  public function isLowerCase(): bool {
    return \mb_strtolower($this->str, $this->encoding) == $this->str;
  }

  /**
   * Converts all characters in the string to uppercase
   *
   * @return MbString new string object with all characters being uppercase
   */
  public function toLowerCase(): MbString {
    $lower = \mb_strtolower($this->str, $this->encoding);
    return new static($lower, $this->encoding);
  }

  /**
   * Checks whether or not the input string contains only lower case characters
   *
   * @return bool returns true if the string contains only lower chars, false otherwise
   */
  public function isTitleCase(): bool {
    return \mb_convert_case($this->str, \MB_CASE_TITLE, $this->encoding) == $this->str;
  }

  /**
   * Converts the first character of each word in the string to uppercase
   *
   * @return MbString new string object with all characters being title-cased
   */
  public function toTitleCase(): MbString {
    $titleCase = \mb_convert_case($this->str, \MB_CASE_TITLE, $this->encoding);
    return new static($titleCase, $this->encoding);
  }

  /**
   * Checks whether the string contains only whitespace chars
   *
   * @return bool returns true if the string contains only whitespace chars, false otherwise
   */
  public function isBlank(): bool {
    return $this->match('/^[[:space:]]{1,}$/');
  }

  /**
   * Checks whether the string contains only hexadecimal chars
   *
   * @return bool returns true if the string contains only hexadecimal chars, false otherwise
   */
  public function isHexadecimal(): bool {
    return $this->match('/^(#|0x){0,1}[[:xdigit:]]{1,}$/');
  }

  /**
   * Checks whether the string contains only binary chars
   *
   * @return bool returns true if the string contains only binary chars, false otherwise
   */
  public function isBinary(): bool {
    return $this->match('/^[0-1]+$/');
  }

  /**
   * Returns the character at the given index
   * 
   * Offsets may be negative to count from the last character in the string.
   *
   * @param  int $index The index from which to retrieve the char
   * @return string the character at the specified index
   * @throws OutOfBoundsException if the index does not exist
   */
  public function charAt(int $index): string {
    $length = $this->length();
    if (($index >= 0 && $length <= $index) || $length < $index) {
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
    $strlen = $this->count();
    $str = $this->str;
    $array = [];
    while ($strlen) {
      $array[] = \mb_substr($this->str, 0, 1, $this->encoding);
      $str = \mb_substr($this->str, 1, $strlen, $this->encoding);
      $strlen = \mb_strlen($str);
    }
    return $array;
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
   */
  public function rewind(): void {
    $this->index = 0;
  }

  /**
   * Returns the current caracter
   * 
   * @return mixed the current caracter
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

  public function next(): void {
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
   * Checks whether a character exists in the query
   * 
   * @param  mixed $offset the name of the parameter
   * @return boolean true if the parameter exists and false otherwise
   */
  public function offsetExists($offset): bool {
    return is_int($offset) && $offset >= 0 && $offset < $this->length();
  }

  /**
   * Returns the character at the given index
   * 
   * @param  mixed $offset
   * @return string
   * @throws OutOfBoundsException if the offset does not exist
   */
  public function offsetGet($offset) {
    return $this->charAt($offset);
  }

  /**
   * 
   * @param  mixed $offset
   * @param  mixed $value
   * @return void
   * @throws BadMethodCallException object is immutable
   */
  public function offsetSet($offset, $value): void {
    throw new BadMethodCallException("Object is immutable, cannot modify chars directly");
  }

  /**
   * 
   * @param  mixed $offset
   * @return void
   * @throws BadMethodCallException always because object is immutable
   */
  public function offsetUnset($offset): void {
    throw new BadMethodCallException("Object is immutable, cannot unset chars directly");
  }

}
