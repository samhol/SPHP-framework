<?php

namespace Sphp\Core\Types;

use ArrayAccess;
use ArrayIterator;
use Countable;
use Exception;
use InvalidArgumentException;
use IteratorAggregate;
use OutOfBoundsException;

class StringObject implements Countable, IteratorAggregate, ArrayAccess {

  /**
   * An instance's string.
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
   * Initializes a StringObject object and assigns both str and encoding properties
   * the supplied values. $str is cast to a string prior to assignment, and if
   * $encoding is not specified, it defaults to mb_internal_encoding(). Throws
   * an InvalidArgumentException if the first argument is an array or object
   * without a __toString method.
   *
   * @param  mixed  $str      Value to modify, after being cast to string
   * @param  string $encoding The character encoding
   * @throws \InvalidArgumentException if an array or object without a
   *         __toString method is passed as the first argument
   */
  public function __construct($str = '', $encoding = null) {
    if (is_array($str)) {
      throw new InvalidArgumentException('Passed value cannot be an array');
    } elseif (is_object($str) && !method_exists($str, '__toString')) {
      throw new InvalidArgumentException('Passed object must have a __toString method');
    }
    $this->str = (string) $str;
    $this->encoding = $encoding ? : \mb_internal_encoding();
  }

  /**
   * Creates a StringObject object and assigns both str and encoding properties
   * the supplied values. $str is cast to a string prior to assignment, and if
   * $encoding is not specified, it defaults to mb_internal_encoding(). It
   * then returns the initialized object. Throws an InvalidArgumentException
   * if the first argument is an array or object without a __toString method.
   *
   * @param  mixed   $str      Value to modify, after being cast to string
   * @param  string  $encoding The character encoding
   * @return StringObject A StringObject object
   * @throws \InvalidArgumentException if an array or object without a
   *         __toString method is passed as the first argument
   */
  public static function create($str = '', $encoding = null) {
    return new static($str, $encoding);
  }

  /**
   * Returns the value in $str.
   *
   * @return string The current value of the $str property
   */
  public function __toString() {
    return $this->str;
  }

  /**
   * Returns the character at $index, with indexes starting at 0
   *
   * @param  int $index position of the character
   * @return string|null the character at $index or null if the index does not exist
   */
  public function charAt($index) {
    $length = $this->length();
    $result = null;
    if ($index >= 0 && $length > $index) {
      $result = mb_substr($this->str, $index, 1, $this->encoding);
    }
    return $result;
  }

  /**
   * Determines if the string length is on a given closed interval
   *
   * @param  int $lower lower limit
   * @param  int $upper upper limit
   * @return boolean true if the string length is on a given closed interval, false otherwise.
   */
  public function lengthBetween($lower, $upper) {
    return ($lower <= $this->count() && $this->count() <= $upper);
  }

  /**
   * Checks whether the string is not empty
   *
   * @return boolean true if the string is not empty, false otherwise
   */
  public function notEmpty() {
    return $this->count() > 0 && !$this->matchesPattern("/^[ \n\r\t]*$/");
  }

  /**
   * Checks whether the string is empty
   * 
   * @return boolean true if the string is empty, false otherwise
   */
  public function isEmpty() {
    return !$this->notEmpty();
  }

  /**
   * Returns the substring between $start and $end, if found, or an empty
   * string. An optional offset may be supplied from which to begin the
   * search for the start string.
   *
   * @param  string $start  Delimiter marking the start of the substring
   * @param  string $end    Delimiter marketing the end of the substring
   * @param  int    $offset Index from which to begin the search
   * @return StringObject Object whose $str has been converted to an URL slug
   */
  public function between($start, $end, $offset = 0) {
    $startIndex = $this->indexOf($start, $offset);
    if ($startIndex === false) {
      return static::create('', $this->encoding);
    }
    $substrIndex = $startIndex + \mb_strlen($start, $this->encoding);
    $endIndex = $this->indexOf($end, $substrIndex);
    if ($endIndex === false) {
      return static::create('', $this->encoding);
    }
    return $this->substr($substrIndex, $endIndex - $substrIndex);
  }

  /**
   * Returns a camelCase version of the string. Trims surrounding spaces,
   * capitalizes letters following digits, spaces, dashes and underscores,
   * and removes spaces, dashes, as well as underscores.
   *
   * @return StringObject Object with $str in camelCase
   */
  public function camelize() {
    $encoding = $this->encoding;
    $stringy = $this->trim()->lowerCaseFirst();
    $stringy->str = preg_replace('/^[-_]+/', '', $stringy->str);
    $stringy->str = preg_replace_callback('/[-_\s]+(.)?/u', function ($match) use ($encoding) {
      if (isset($match[1])) {
        return \mb_strtoupper($match[1], $encoding);
      }
      return '';
    }, $stringy->str
    );
    $stringy->str = preg_replace_callback('/[\d]+(.)?/u', function ($match) use ($encoding) {
      return \mb_strtoupper($match[0], $encoding);
    }, $stringy->str
    );
    return $stringy;
  }

  /**
   * Returns an array consisting of the characters in the string.
   *
   * @return array An array of string chars
   */
  public function chars() {
    $chars = array();
    for ($i = 0, $l = $this->length(); $i < $l; $i++) {
      $chars[] = $this->charAt($i)->str;
    }
    return $chars;
  }

  /**
   * Trims the string and replaces consecutive whitespace characters with a
   * single space. This includes tabs and newline characters, as well as
   * multibyte whitespace such as the thin space and ideographic space.
   *
   * @return StringObject Object with a trimmed $str and condensed whitespace
   */
  public function collapseWhitespace() {
    return $this->regexReplace('[[:space:]]+', ' ')->trim();
  }

  /**
   * Returns true if the string contains $needle, false otherwise. By default
   * the comparison is case-sensitive, but can be made insensitive by setting
   * $caseSensitive to false.
   *
   * @param  string $needle        Substring to look for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return bool   Whether or not $str contains $needle
   */
  public function contains($needle, $caseSensitive = true) {
    $encoding = $this->encoding;
    if ($caseSensitive) {
      return (\mb_strpos($this->str, $needle, 0, $encoding) !== false);
    }
    return (\mb_stripos($this->str, $needle, 0, $encoding) !== false);
  }

  /**
   * Returns true if the string contains all $needles, false otherwise. By
   * default the comparison is case-sensitive, but can be made insensitive by
   * setting $caseSensitive to false.
   *
   * @param  array  $needles       Substrings to look for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return bool   Whether or not $str contains $needle
   */
  public function containsAll($needles, $caseSensitive = true) {
    if (empty($needles)) {
      return false;
    }
    foreach ($needles as $needle) {
      if (!$this->contains($needle, $caseSensitive)) {
        return false;
      }
    }
    return true;
  }

  /**
   * Returns true if the string contains any $needles, false otherwise. By
   * default the comparison is case-sensitive, but can be made insensitive by
   * setting $caseSensitive to false.
   *
   * @param  array  $needles       Substrings to look for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return bool   Whether or not $str contains $needle
   */
  public function containsAny($needles, $caseSensitive = true) {
    if (empty($needles)) {
      return false;
    }
    foreach ($needles as $needle) {
      if ($this->contains($needle, $caseSensitive)) {
        return true;
      }
    }
    return false;
  }

  /**
   * Returns the length of the string, implementing the countable interface.
   *
   * @return int The number of characters in the string, given the encoding
   */
  public function count() {
    return $this->length();
  }

  /**
   * Returns the number of occurrences of $substring in the given string.
   * By default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $substring     The substring to search for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return int    The number of $substring occurrences
   */
  public function countSubstr($substring, $caseSensitive = true) {
    if ($caseSensitive) {
      return \mb_substr_count($this->str, $substring, $this->encoding);
    }
    $str = \mb_strtoupper($this->str, $this->encoding);
    $substring = \mb_strtoupper($substring, $this->encoding);
    return \mb_substr_count($str, $substring, $this->encoding);
  }

  /**
   * Returns a lowercase and trimmed string separated by dashes. Dashes are
   * inserted before uppercase characters (with the exception of the first
   * character of the string), and in place of spaces as well as underscores.
   *
   * @return StringObject Object with a dasherized $str
   */
  public function dasherize() {
    return $this->delimit('-');
  }

  /**
   * Returns a lowercase and trimmed string separated by the given delimiter.
   * Delimiters are inserted before uppercase characters (with the exception
   * of the first character of the string), and in place of spaces, dashes,
   * and underscores. Alpha delimiters are not converted to lowercase.
   *
   * @param  string  $delimiter Sequence used to separate parts of the string
   * @return StringObject Object with a delimited $str
   */
  public function delimit($delimiter) {
    $regexEncoding = $this->regexEncoding();
    $this->regexEncoding($this->encoding);
    $str = $this->eregReplace('\B([A-Z])', '-\1', $this->trim());
    $str = \mb_strtolower($str, $this->encoding);
    $str = $this->eregReplace('[-_\s]+', $delimiter, $str);
    $this->regexEncoding($regexEncoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Returns true if the string ends with $substring, false otherwise. By
   * default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $substring     The substring to look for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return bool   Whether or not $str ends with $substring
   */
  public function endsWith($substring, $caseSensitive = true) {
    $substringLength = \mb_strlen($substring, $this->encoding);
    $strLength = $this->length();
    $endOfStr = \mb_substr($this->str, $strLength - $substringLength, $substringLength, $this->encoding);
    if (!$caseSensitive) {
      $substring = \mb_strtolower($substring, $this->encoding);
      $endOfStr = \mb_strtolower($endOfStr, $this->encoding);
    }
    return (string) $substring === $endOfStr;
  }

  /**
   * Ensures that the string begins with $substring. If it doesn't, it's
   * prepended.
   *
   * @param  string  $substring The substring to add if not present
   * @return StringObject Object with its $str prefixed by the $substring
   */
  public function ensureLeft($substring) {
    $stringy = static::create($this->str, $this->encoding);
    if (!$stringy->startsWith($substring)) {
      $stringy->str = $substring . $stringy->str;
    }
    return $stringy;
  }

  /**
   * Ensures that the string ends with $substring. If it doesn't, it's
   * appended.
   *
   * @param  string  $substring The substring to add if not present
   * @return StringObject Object with its $str suffixed by the $substring
   */
  public function ensureRight($substring) {
    $stringy = static::create($this->str, $this->encoding);
    if (!$stringy->endsWith($substring)) {
      $stringy->str .= $substring;
    }
    return $stringy;
  }

  /**
   * Returns the first $n characters of the string.
   *
   * @param  int     $n Number of characters to retrieve from the start
   * @return StringObject Object with its $str being the first $n chars
   */
  public function first($n) {
    $stringy = static::create($this->str, $this->encoding);
    if ($n < 0) {
      $stringy->str = '';
      return $stringy;
    }
    return $stringy->substr(0, $n);
  }

  /**
   * Returns the encoding used by the StringObject object.
   *
   * @return string The current value of the $encoding property
   */
  public function getEncoding() {
    return $this->encoding;
  }

  /**
   * Returns a new ArrayIterator, thus implementing the IteratorAggregate
   * interface. The ArrayIterator's constructor is passed an array of chars
   * in the multibyte string. This enables the use of foreach with instances
   * of StringObject\StringObject.
   *
   * @return \ArrayIterator An iterator for the characters in the string
   */
  public function getIterator() {
    return new ArrayIterator($this->chars());
  }

  /**
   * Returns true if the string contains a lower case char, false
   * otherwise.
   *
   * @return bool Whether or not the string contains a lower case character.
   */
  public function hasLowerCase() {
    return $this->matchesPattern('.*[[:lower:]]');
  }

  /**
   * Returns true if the string contains an upper case char, false
   * otherwise.
   *
   * @return bool Whether or not the string contains an upper case character.
   */
  public function hasUpperCase() {
    return $this->matchesPattern('.*[[:upper:]]');
  }

  /**
   * Convert all HTML entities to their applicable characters. An alias of
   * html_entity_decode. For a list of flags, refer to
   * http://php.net/manual/en/function.html-entity-decode.php
   *
   * @param  int|null $flags Optional flags
   * @return StringObject  Object with the resulting $str after being html decoded.
   */
  public function htmlDecode($flags = ENT_COMPAT) {
    $str = html_entity_decode($this->str, $flags, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Convert all applicable characters to HTML entities. An alias of
   * htmlentities. Refer to http://php.net/manual/en/function.htmlentities.php
   * for a list of flags.
   *
   * @param  int|null $flags Optional flags
   * @return StringObject  Object with the resulting $str after being html encoded.
   */
  public function htmlEncode($flags = ENT_COMPAT) {
    $str = htmlentities($this->str, $flags, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Capitalizes the first word of the string, replaces underscores with
   * spaces, and strips '_id'.
   *
   * @return StringObject Object with a humanized $str
   */
  public function humanize() {
    $str = str_replace(array('_id', '_'), array('', ' '), $this->str);
    return static::create($str, $this->encoding)->trim()->upperCaseFirst();
  }

  /**
   * Returns the index of the first occurrence of $needle in the string,
   * and false if not found. Accepts an optional offset from which to begin
   * the search.
   *
   * @param  string   $needle Substring to look for
   * @param  int      $offset Offset from which to search
   * @return int|bool The occurrence's index if found, otherwise false
   */
  public function indexOf($needle, $offset = 0) {
    return \mb_strpos($this->str, (string) $needle, (int) $offset, $this->encoding);
  }

  /**
   * Returns the index of the last occurrence of $needle in the string,
   * and false if not found. Accepts an optional offset from which to begin
   * the search. Offsets may be negative to count from the last character
   * in the string.
   *
   * @param  string   $needle Substring to look for
   * @param  int      $offset Offset from which to search
   * @return int|bool The last occurrence's index if found, otherwise false
   */
  public function indexOfLast($needle, $offset = 0) {
    return \mb_strrpos($this->str, (string) $needle, (int) $offset, $this->encoding);
  }

  /**
   * Inserts $substring into the string at the $index provided.
   *
   * @param  string  $substring String to be inserted
   * @param  int     $index     The index at which to insert the substring
   * @return StringObject Object with the resulting $str after the insertion
   */
  public function insert($substring, $index) {
    $stringy = static::create($this->str, $this->encoding);
    if ($index > $stringy->length()) {
      return $stringy;
    }
    $start = \mb_substr($stringy->str, 0, $index, $stringy->encoding);
    $end = \mb_substr($stringy->str, $index, $stringy->length(), $stringy->encoding);
    $stringy->str = $start . $substring . $end;
    return $stringy;
  }

  /**
   * Returns true if the string contains only alphabetic chars, false
   * otherwise.
   *
   * @return bool Whether or not $str contains only alphabetic chars
   */
  public function isAlpha() {
    return $this->matchesPattern('^[[:alpha:]]*$');
  }

  /**
   * Returns true if the string contains only alphabetic and numeric chars,
   * false otherwise.
   *
   * @return bool Whether or not $str contains only alphanumeric chars
   */
  public function isAlphanumeric() {
    return $this->matchesPattern('^[[:alnum:]]*$');
  }

  /**
   * Returns true if the string contains only whitespace chars, false
   * otherwise.
   *
   * @return bool Whether or not $str contains only whitespace characters
   */
  public function isBlank() {
    return $this->matchesPattern('^[[:space:]]*$');
  }

  /**
   * Returns true if the string contains only hexadecimal chars, false
   * otherwise.
   *
   * @return bool Whether or not $str contains only hexadecimal chars
   */
  public function isHexadecimal() {
    return $this->matchesPattern('^[[:xdigit:]]*$');
  }

  /**
   * Returns true if the string is JSON, false otherwise. Unlike json_decode
   * in PHP 5.x, this method is consistent with PHP 7 and other JSON parsers,
   * in that an empty string is not considered valid JSON.
   *
   * @return bool Whether or not $str is JSON
   */
  public function isJson() {
    if (!$this->length()) {
      return false;
    }
    json_decode($this->str);
    return (json_last_error() === JSON_ERROR_NONE);
  }

  /**
   * Returns true if the string contains only lower case chars, false
   * otherwise.
   *
   * @return bool Whether or not $str contains only lower case characters
   */
  public function isLowerCase() {
    return $this->matchesPattern('^[[:lower:]]*$');
  }

  /**
   * Returns true if the string is serialized, false otherwise.
   *
   * @return bool Whether or not $str is serialized
   */
  public function isSerialized() {
    return $this->str === 'b:0;' || @unserialize($this->str) !== false;
  }

  /**
   * Returns true if the string is base64 encoded, false otherwise.
   *
   * @return bool Whether or not $str is base64 encoded
   */
  public function isBase64() {
    return (base64_encode(base64_decode($this->str, true)) === $this->str);
  }

  /**
   * Returns true if the string contains only lower case chars, false
   * otherwise.
   *
   * @return bool Whether or not $str contains only lower case characters
   */
  public function isUpperCase() {
    return $this->matchesPattern('^[[:upper:]]*$');
  }

  /**
   * Returns the last $n characters of the string.
   *
   * @param  int     $n Number of characters to retrieve from the end
   * @return StringObject Object with its $str being the last $n chars
   */
  public function last($n) {
    $stringy = static::create($this->str, $this->encoding);
    if ($n <= 0) {
      $stringy->str = '';
      return $stringy;
    }
    return $stringy->substr(-$n);
  }

  /**
   * Returns the length of the string. An alias for PHP's mb_strlen() function.
   *
   * @return int The number of characters in $str given the encoding
   */
  public function length() {
    return \mb_strlen($this->str, $this->encoding);
  }

  /**
   * Splits on newlines and carriage returns, returning an array of StringObject
   * objects corresponding to the lines in the string.
   *
   * @return StringObject[] An array of StringObject objects
   */
  public function lines() {
    $array = $this->split('[\r\n]{1,2}', $this->str);
    for ($i = 0; $i < count($array); $i++) {
      $array[$i] = static::create($array[$i], $this->encoding);
    }
    return $array;
  }

  /**
   * Returns the longest common prefix between the string and $otherStr.
   *
   * @param  string  $otherStr Second string for comparison
   * @return StringObject Object with its $str being the longest common prefix
   */
  public function longestCommonPrefix($otherStr) {
    $encoding = $this->encoding;
    $maxLength = min($this->length(), \mb_strlen($otherStr, $encoding));
    $longestCommonPrefix = '';
    for ($i = 0; $i < $maxLength; $i++) {
      $char = \mb_substr($this->str, $i, 1, $encoding);
      if ($char == \mb_substr($otherStr, $i, 1, $encoding)) {
        $longestCommonPrefix .= $char;
      } else {
        break;
      }
    }
    return static::create($longestCommonPrefix, $encoding);
  }

  /**
   * Returns the longest common suffix between the string and $otherStr.
   *
   * @param  string  $otherStr Second string for comparison
   * @return StringObject Object with its $str being the longest common suffix
   */
  public function longestCommonSuffix($otherStr) {
    $encoding = $this->encoding;
    $maxLength = min($this->length(), \mb_strlen($otherStr, $encoding));
    $longestCommonSuffix = '';
    for ($i = 1; $i <= $maxLength; $i++) {
      $char = \mb_substr($this->str, -$i, 1, $encoding);
      if ($char == \mb_substr($otherStr, -$i, 1, $encoding)) {
        $longestCommonSuffix = $char . $longestCommonSuffix;
      } else {
        break;
      }
    }
    return static::create($longestCommonSuffix, $encoding);
  }

  /**
   * Returns the longest common substring between the string and $otherStr.
   * In the case of ties, it returns that which occurs first.
   *
   * @param  string  $otherStr Second string for comparison
   * @return StringObject Object with its $str being the longest common substring
   */
  public function longestCommonSubstring($otherStr) {
    // Uses dynamic programming to solve
    // http://en.wikipedia.org/wiki/Longest_common_substring_problem
    $encoding = $this->encoding;
    $stringy = static::create($this->str, $encoding);
    $strLength = $stringy->length();
    $otherLength = \mb_strlen($otherStr, $encoding);
    // Return if either string is empty
    if ($strLength == 0 || $otherLength == 0) {
      $stringy->str = '';
      return $stringy;
    }
    $len = 0;
    $end = 0;
    $table = array_fill(0, $strLength + 1, array_fill(0, $otherLength + 1, 0));
    for ($i = 1; $i <= $strLength; $i++) {
      for ($j = 1; $j <= $otherLength; $j++) {
        $strChar = \mb_substr($stringy->str, $i - 1, 1, $encoding);
        $otherChar = \mb_substr($otherStr, $j - 1, 1, $encoding);
        if ($strChar == $otherChar) {
          $table[$i][$j] = $table[$i - 1][$j - 1] + 1;
          if ($table[$i][$j] > $len) {
            $len = $table[$i][$j];
            $end = $i;
          }
        } else {
          $table[$i][$j] = 0;
        }
      }
    }
    $stringy->str = \mb_substr($stringy->str, $end - $len, $len, $encoding);
    return $stringy;
  }

  /**
   * Converts the first character of the string to lower case.
   *
   * @return StringObject Object with the first character of $str being lower case
   */
  public function lowerCaseFirst() {
    $first = \mb_substr($this->str, 0, 1, $this->encoding);
    $rest = \mb_substr($this->str, 1, $this->length() - 1, $this->encoding);
    $str = \mb_strtolower($first, $this->encoding) . $rest;
    return static::create($str, $this->encoding);
  }

  /**
   * Returns whether or not a character exists at an index. Offsets may be
   * negative to count from the last character in the string. Implements
   * part of the ArrayAccess interface.
   *
   * @param  mixed   $offset The index to check
   * @return boolean Whether or not the index exists
   */
  public function offsetExists($offset) {
    $length = $this->length();
    $offset = (int) $offset;
    if ($offset >= 0) {
      return ($length > $offset);
    }
    return ($length >= abs($offset));
  }

  /**
   * Returns the character at the given index. Offsets may be negative to
   * count from the last character in the string. Implements part of the
   * ArrayAccess interface, and throws an OutOfBoundsException if the index
   * does not exist.
   *
   * @param  mixed $offset         The index from which to retrieve the char
   * @return mixed                 The character at the specified index
   * @throws \OutOfBoundsException If the positive or negative offset does
   *                               not exist
   */
  public function offsetGet($offset) {
    $offset = (int) $offset;
    $length = $this->length();
    if (($offset >= 0 && $length <= $offset) || $length < abs($offset)) {
      throw new OutOfBoundsException('No character exists at the index');
    }
    return \mb_substr($this->str, $offset, 1, $this->encoding);
  }

  /**
   * Implements part of the ArrayAccess interface, but throws an exception
   * when called. This maintains the immutability of StringObject objects.
   *
   * @param  mixed      $offset The index of the character
   * @param  mixed      $value  Value to set
   * @throws \Exception When called
   */
  public function offsetSet($offset, $value) {
    // StringObject is immutable, cannot directly set char
    throw new Exception('StringObject object is immutable, cannot modify char');
  }

  /**
   * Implements part of the ArrayAccess interface, but throws an exception
   * when called. This maintains the immutability of StringObject objects.
   *
   * @param  mixed      $offset The index of the character
   * @throws \Exception When called
   */
  public function offsetUnset($offset) {
    // Don't allow directly modifying the string
    throw new Exception('StringObject object is immutable, cannot unset char');
  }

  /**
   * Returns a new string starting with $string.
   *
   * @param  string  $string The string to append
   * @return StringObject Object with appended $string
   */
  public function prepend($string) {
    return static::create($string . $this->str, $this->encoding);
  }

  /**
   * Replaces all occurrences of $pattern in $str by $replacement. An alias
   * for mb_ereg_replace(). Note that the 'i' option with multibyte patterns
   * in mb_ereg_replace() requires PHP 5.6+ for correct results. This is due
   * to a lack of support in the bundled version of Oniguruma in PHP < 5.6,
   * and current versions of HHVM (3.8 and below).
   *
   * @param  string  $pattern     The regular expression pattern
   * @param  string  $replacement The string to replace with
   * @param  string  $options     Matching conditions to be used
   * @return StringObject Object with the resulting $str after the replacements
   */
  public function regexReplace($pattern, $replacement, $options = 'msr') {
    $regexEncoding = $this->regexEncoding();
    $this->regexEncoding($this->encoding);
    $str = $this->eregReplace($pattern, $replacement, $this->str, $options);
    $this->regexEncoding($regexEncoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Returns a new string with the prefix $substring removed, if present.
   *
   * @param  string  $substring The prefix to remove
   * @return StringObject Object having a $str without the prefix $substring
   */
  public function removeLeft($substring) {
    $stringy = static::create($this->str, $this->encoding);
    if ($stringy->startsWith($substring)) {
      $substringLength = \mb_strlen($substring, $stringy->encoding);
      return $stringy->substr($substringLength);
    }
    return $stringy;
  }

  /**
   * Returns a new string with the suffix $substring removed, if present.
   *
   * @param  string  $substring The suffix to remove
   * @return StringObject Object having a $str without the suffix $substring
   */
  public function removeRight($substring) {
    $stringy = static::create($this->str, $this->encoding);
    if ($stringy->endsWith($substring)) {
      $substringLength = \mb_strlen($substring, $stringy->encoding);
      return $stringy->substr(0, $stringy->length() - $substringLength);
    }
    return $stringy;
  }

  /**
   * Returns a repeated string given a multiplier. An alias for str_repeat.
   *
   * @param  int     $multiplier The number of times to repeat the string
   * @return StringObject Object with a repeated str
   */
  public function repeat($multiplier) {
    $repeated = str_repeat($this->str, $multiplier);
    return static::create($repeated, $this->encoding);
  }

  /**
   * Replaces all occurrences of $search in $str by $replacement.
   *
   * @param  string  $search      The needle to search for
   * @param  string  $replacement The string to replace with
   * @return StringObject Object with the resulting $str after the replacements
   */
  public function replace($search, $replacement) {
    return $this->regexReplace(preg_quote($search), $replacement);
  }

  /**
   * Returns a reversed string. A multibyte version of strrev().
   *
   * @return StringObject Object with a reversed $str
   */
  public function reverse() {
    $strLength = $this->length();
    $reversed = '';
    // Loop from last index of string to first
    for ($i = $strLength - 1; $i >= 0; $i--) {
      $reversed .= \mb_substr($this->str, $i, 1, $this->encoding);
    }
    return static::create($reversed, $this->encoding);
  }

  /**
   * Truncates the string to a given length, while ensuring that it does not
   * split words. If $substring is provided, and truncating occurs, the
   * string is further truncated so that the substring may be appended without
   * exceeding the desired length.
   *
   * @param  int     $length    Desired length of the truncated string
   * @param  string  $substring The substring to append if it can fit
   * @return StringObject Object with the resulting $str after truncating
   */
  public function safeTruncate($length, $substring = '') {
    $stringy = static::create($this->str, $this->encoding);
    if ($length >= $stringy->length()) {
      return $stringy;
    }
    // Need to further trim the string so we can append the substring
    $encoding = $stringy->encoding;
    $substringLength = \mb_strlen($substring, $encoding);
    $length = $length - $substringLength;
    $truncated = \mb_substr($stringy->str, 0, $length, $encoding);
    // If the last word was truncated
    if (mb_strpos($stringy->str, ' ', $length - 1, $encoding) != $length) {
      // Find pos of the last occurrence of a space, get up to that
      $lastPos = \mb_strrpos($truncated, ' ', 0, $encoding);
      $truncated = \mb_substr($truncated, 0, $lastPos, $encoding);
    }
    $stringy->str = $truncated . $substring;
    return $stringy;
  }

  /*
   * A multibyte str_shuffle() function. It returns a string with its
   * characters in random order.
   *
   * @return StringObject Object with a shuffled $str
   */

  public function shuffle() {
    $indexes = range(0, $this->length() - 1);
    shuffle($indexes);
    $shuffledStr = '';
    foreach ($indexes as $i) {
      $shuffledStr .= \mb_substr($this->str, $i, 1, $this->encoding);
    }
    return static::create($shuffledStr, $this->encoding);
  }

  /**
   * Returns true if the string begins with $substring, false otherwise. By
   * default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $substring     The substring to look for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @return bool   Whether or not $str starts with $substring
   */
  public function startsWith($substring, $caseSensitive = true) {
    $substringLength = \mb_strlen($substring, $this->encoding);
    $startOfStr = \mb_substr($this->str, 0, $substringLength, $this->encoding);
    if (!$caseSensitive) {
      $substring = \mb_strtolower($substring, $this->encoding);
      $startOfStr = \mb_strtolower($startOfStr, $this->encoding);
    }
    return (string) $substring === $startOfStr;
  }

  /**
   * Returns the substring beginning at $start, and up to, but not including
   * the index specified by $end. If $end is omitted, the function extracts
   * the remaining string. If $end is negative, it is computed from the end
   * of the string.
   *
   * @param  int     $start Initial index from which to begin extraction
   * @param  int     $end   Optional index at which to end extraction
   * @return StringObject Object with its $str being the extracted substring
   */
  public function slice($start, $end = null) {
    if ($end === null) {
      $length = $this->length();
    } elseif ($end >= 0 && $end <= $start) {
      return static::create('', $this->encoding);
    } elseif ($end < 0) {
      $length = $this->length() + $end - $start;
    } else {
      $length = $end - $start;
    }
    $str = \mb_substr($this->str, $start, $length, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Splits the string with the provided regular expression, returning an
   * array of StringObject objects. An optional integer $limit will truncate the
   * results.
   *
   * @param  string    $pattern The regex with which to split the string
   * @param  int       $limit   Optional maximum number of results to return
   * @return StringObject[] An array of StringObject objects
   */
  public function split($pattern, $limit = null) {
    if ($limit === 0) {
      return array();
    }
    // mb_split errors when supplied an empty pattern in < PHP 5.4.13
    // and HHVM < 3.8
    if ($pattern === '') {
      return array(static::create($this->str, $this->encoding));
    }
    $regexEncoding = $this->regexEncoding();
    $this->regexEncoding($this->encoding);
    // mb_split returns the remaining unsplit string in the last index when
    // supplying a limit
    $limit = ($limit > 0) ? $limit += 1 : -1;
    static $functionExists;
    if ($functionExists === null) {
      $functionExists = function_exists('\mb_split');
    }
    if ($functionExists) {
      $array = \mb_split($pattern, $this->str, $limit);
    } else if ($this->supportsEncoding()) {
      $array = \preg_split("/$pattern/", $this->str, $limit);
    }
    $this->regexEncoding($regexEncoding);
    if ($limit > 0 && count($array) === $limit) {
      array_pop($array);
    }
    for ($i = 0; $i < count($array); $i++) {
      $array[$i] = static::create($array[$i], $this->encoding);
    }
    return $array;
  }

  /**
   * Returns the substring beginning at $start with the specified $length.
   * It differs from the mb_substr() function in that providing a $length of
   * null will return the rest of the string, rather than an empty string.
   *
   * @param  int     $start  Position of the first character to use
   * @param  int     $length Maximum number of characters used
   * @return StringObject Object with its $str being the substring
   */
  public function substr($start, $length = null) {
    $length = $length === null ? $this->length() : $length;
    $str = \mb_substr($this->str, $start, $length, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Surrounds $str with the given substring.
   *
   * @param  string  $substring The substring to add to both sides
   * @return StringObject Object whose $str had the substring both prepended and
   *                 appended
   */
  public function surround($substring) {
    $str = implode('', array($substring, $this->str, $substring));
    return static::create($str, $this->encoding);
  }

  /**
   * Converts all characters in the string to lowercase. An alias for PHP's
   * mb_strtolower().
   *
   * @return StringObject Object with all characters of $str being lowercase
   */
  public function toLowerCase() {
    $str = \mb_strtolower($this->str, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Converts each tab in the string to some number of spaces, as defined by
   * $tabLength. By default, each tab is converted to 4 consecutive spaces.
   *
   * @param  int     $tabLength Number of spaces to replace each tab with
   * @return StringObject Object whose $str has had tabs switched to spaces
   */
  public function toSpaces($tabLength = 4) {
    $spaces = str_repeat(' ', $tabLength);
    $str = str_replace("\t", $spaces, $this->str);
    return static::create($str, $this->encoding);
  }

  /**
   * Converts each occurrence of some consecutive number of spaces, as
   * defined by $tabLength, to a tab. By default, each 4 consecutive spaces
   * are converted to a tab.
   *
   * @param  int     $tabLength Number of spaces to replace with a tab
   * @return StringObject Object whose $str has had spaces switched to tabs
   */
  public function toTabs($tabLength = 4) {
    $spaces = str_repeat(' ', $tabLength);
    $str = str_replace($spaces, "\t", $this->str);
    return static::create($str, $this->encoding);
  }

  /**
   * Converts the first character of each word in the string to uppercase.
   *
   * @return StringObject Object with all characters of $str being title-cased
   */
  public function toTitleCase() {
    $str = \mb_convert_case($this->str, \MB_CASE_TITLE, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Converts all characters in the string to uppercase. An alias for PHP's
   * mb_strtoupper().
   *
   * @return StringObject Object with all characters of $str being uppercase
   */
  public function toUpperCase() {
    $str = \mb_strtoupper($this->str, $this->encoding);
    return static::create($str, $this->encoding);
  }

  /**
   * Returns a string with whitespace removed from the start and end of the
   * string. Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string  $chars Optional string of characters to strip
   * @return StringObject Object with a trimmed $str
   */
  public function trim($chars = null) {
    $chars = ($chars) ? preg_quote($chars) : '[:space:]';
    return $this->regexReplace("^[$chars]+|[$chars]+\$", '');
  }

  /**
   * Returns a string with whitespace removed from the start of the string.
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string  $chars Optional string of characters to strip
   * @return StringObject Object with a trimmed $str
   */
  public function trimLeft($chars = null) {
    $chars = ($chars) ? preg_quote($chars) : '[:space:]';
    return $this->regexReplace("^[$chars]+", '');
  }

  /**
   * Returns a string with whitespace removed from the end of the string.
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string  $chars Optional string of characters to strip
   * @return StringObject Object with a trimmed $str
   */
  public function trimRight($chars = null) {
    $chars = ($chars) ? preg_quote($chars) : '[:space:]';
    return $this->regexReplace("[$chars]+\$", '');
  }

  /**
   * Returns a lowercase and trimmed string separated by underscores.
   * Underscores are inserted before uppercase characters (with the exception
   * of the first character of the string), and in place of spaces as well as
   * dashes.
   *
   * @return StringObject Object with an underscored $str
   */
  public function underscored() {
    return $this->delimit('_');
  }

  /**
   * Returns an UpperCamelCase version of the supplied string. It trims
   * surrounding spaces, capitalizes letters following digits, spaces, dashes
   * and underscores, and removes spaces, dashes, underscores.
   *
   * @return StringObject Object with $str in UpperCamelCase
   */
  public function upperCamelize() {
    return $this->camelize()->upperCaseFirst();
  }

  /**
   * Converts the first character of the supplied string to upper case.
   *
   * @return StringObject Object with the first character of $str being upper case
   */
  public function upperCaseFirst() {
    $first = \mb_substr($this->str, 0, 1, $this->encoding);
    $rest = \mb_substr($this->str, 1, $this->length() - 1, $this->encoding);
    $str = \mb_strtoupper($first, $this->encoding) . $rest;
    return static::create($str, $this->encoding);
  }

  /**
   * Returns true if $str matches the supplied pattern, false otherwise.
   *
   * @param  string $pattern Regex pattern to match against
   * @return bool   Whether or not $str matches the pattern
   */
  private function matchesPattern($pattern) {
    $regexEncoding = $this->regexEncoding();
    $this->regexEncoding($this->encoding);
    $match = \mb_ereg_match($pattern, $this->str);
    $this->regexEncoding($regexEncoding);
    return $match;
  }

  /**
   * Alias for mb_ereg_replace with a fallback to preg_replace if the
   * mbstring module is not installed.
   */
  private function eregReplace($pattern, $replacement, $string, $option = 'msr') {
    static $functionExists;
    if ($functionExists === null) {
      $functionExists = function_exists('\mb_split');
    }
    if ($functionExists) {
      return \mb_ereg_replace($pattern, $replacement, $string, $option);
    } else if ($this->supportsEncoding()) {
      $option = str_replace('r', '', $option);
      return \preg_replace("/$pattern/u$option", $replacement, $string);
    }
  }

  /**
   * Alias for mb_regex_encoding which default to a noop if the mbstring
   * module is not installed.
   */
  private function regexEncoding() {
    static $functionExists;
    if ($functionExists === null) {
      $functionExists = function_exists('\mb_regex_encoding');
    }
    if ($functionExists) {
      $args = func_get_args();
      return call_user_func_array('\mb_regex_encoding', $args);
    }
  }

  private function supportsEncoding() {
    $supported = array('UTF-8' => true, 'ASCII' => true);
    if (isset($supported[$this->encoding])) {
      return true;
    } else {
      throw new \RuntimeExpception('StringObject method requires the ' .
      'mbstring module for encodings other than ASCII and UTF-8');
    }
  }

}
