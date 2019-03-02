<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\LogicException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;

/**
 * Utility class for multibyte string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Strings {

  /**
   * Performs a regular expression match
   *
   * @param  string $string the input string
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return boolean true if string matches to the regular expression, false otherwise
   */
  public static function match(string $string, string $pattern, string $encoding = null): bool {
    $e = ErrorToExceptionThrower::getInstance(InvalidArgumentException::class)->start();
    $result = preg_match($pattern, $string) === 1;
     $e->stop();
    return $result;
  }

  /**
   * Replaces a regular expression with multibyte support
   *
   * @param  string $string the input string
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $replacement the replacement text.
   * @param  string $option
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string|boolean the resultant string on success, or false on error
   * @link   http://php.net/manual/en/function.mb-ereg-replace.php
   */
  public static function regexReplace(string $string, string $pattern, string $replacement, $option = null, $encoding = null): string {
    $regexEncoding = mb_regex_encoding();
    mb_regex_encoding(self::getEncoding($encoding));
    if ($option === null) {
      $option = 'msr';
    }
    // echo "pattern:$pattern\n";
    $result = \mb_ereg_replace($pattern, $replacement, $string, $option);
    mb_regex_encoding($regexEncoding);
    return $result;
  }

  /**
   * Replaces all occurrences of $search in $str by $replacement
   *
   * @param  string $string the input string
   * @param  string $search      The needle to search for
   * @param  string $replacement The string to replace with
   * @return string the resulting string after the replacements
   */
  public static function replace(string $string, string $search, string $replacement): string {
    return static::regexReplace($string, preg_quote($search), $replacement);
  }

  /**
   * Returns a reversed string
   *
   * @param  string $string the input string
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string string reversed string 
   */
  public static function reverse(string $string, string $encoding = null): string {
    $strLength = static::length($string, $encoding);
    $reversed = '';
    for ($i = $strLength - 1; $i >= 0; $i--) {
      $reversed .= \mb_substr($string, $i, 1, static::getEncoding($encoding));
    }
    return $reversed;
  }

  /**
   * Returns a string with whitespace removed from the start and end of the string 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string $string the input string
   * @param  string  $charMask optional string of characters to strip
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string trimmed string 
   */
  public static function trim(string $string, string $charMask = null, string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+|[$chars]+$", '', 'msr', static::getEncoding($encoding));
  }

  /**
   * Returns a string with whitespace removed from the start of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string $string the input string
   * @param  string  $charMask optional string of characters to strip
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string trimmed string 
   */
  public static function trimLeft(string $string, string $charMask = null, string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+", '', 'msr', static::getEncoding($encoding));
  }

  /**
   * Returns a string with whitespace removed from the end of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string $string the input string
   * @param  string  $charMask optional string of characters to strip
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string trimmed string 
   */
  public static function trimRight(string $string, string $charMask = null, string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "[$chars]+$", '', 'msr', static::getEncoding($encoding));
  }

  /**
   * Trims the string and replaces consecutive whitespace characters with a
   * single space
   * 
   * This includes tabs and newline characters, as well as multibyte whitespace 
   * such as the thin space and ideographic space.
   *
   * @param  string $string the input string
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string the trimmed string
   */
  public static function collapseWhitespace(string $string, string $encoding = null): string {
    $enc = self::getEncoding($encoding);
    $collapsed = static::regexReplace($string, '[[:space:]]+', ' ', 'msr', $enc);
    return static::trim($collapsed, null, $enc);
  }

  /**
   * Tests whether the string contains the substring or not
   *
   * @param  string $haystack the string being checked
   * @param  string $needle the substring to search for
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return boolean true if needle was found from the haystack string, false otherwise
   */
  public static function contains(string $haystack, string $needle, string $encoding = null): bool {
    return (mb_stripos($haystack, $needle, 0, self::getEncoding($encoding)) !== false);
  }

  /**
   * Checks whether the haystack string contains all $needles
   *
   * @param  string $haystack the string being checked
   * @param  string[] $needles Substrings to look for
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return bool whether or not the haystack contains $needle
   */
  public static function containsAll(string $haystack, array $needles, string $encoding = null): bool {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if (!self::contains($haystack, (string) $needle, $encoding)) {
          return false;
        }
      }
      return true;
    }
  }

  /**
   * Checks whether the string contains any of the needles
   *
   * @param  string $haystack the string being checked
   * @param  string[] $needles Substrings to look for
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return bool whether the string contains any of the needles
   */
  public static function containsAny(string $haystack, array $needles, string $encoding = null): bool {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if (static::contains($haystack, (string) $needle, $encoding)) {
          return true;
        }
      }
      return false;
    }
  }

  /**
   * Returns the number of occurrences of $substring in the given string
   * 
   * By default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $string the string being checked
   * @param  string $substring     The substring to search for
   * @param  boolean $caseSensitive Whether or not to enforce case-sensitivity
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return int The number of $substring occurrences
   */
  public static function countSubstr(string $string, string $substring, bool $caseSensitive = true, string $encoding = null): int {
    $enc = self::getEncoding($encoding);
    if (!$caseSensitive) {
      $string = \mb_strtoupper($string, $enc);
      $substring = \mb_strtoupper($substring, $enc);
    }
    return \mb_substr_count($string, $substring, $enc);
  }

  /**
   * Checks whether a $haystack string starts with any of the given needles
   *
   * @param  string $haystack the string being checked
   * @param  string $needle the start to compare with
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return boolean true if the haystack starts with any of the given needles
   */
  public static function startsWith(string $haystack, string $needle, $encoding = null): bool {
    return $needle === '' || mb_strrpos($haystack, $needle, 0, self::getEncoding($encoding)) === 0;
  }

  /**
   * Checks whether a haystack string ends with any of the given needles
   *
   * @param  string $haystack the string being checked
   * @param  string $needle the ending to compare with
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return boolean true if the haystack ends with any of the given needles
   */
  public static function endsWith(string $haystack, $needle, $encoding = null): bool {
    if ($needle === '') {
      return true;
    } else {
      $enc = static::getEncoding($encoding);
      return \mb_substr($haystack, -\mb_strlen($needle, $enc), null, $enc) === $needle;
    }
  }

  /**
   * Returns the character at $index, with indexes starting at 0
   *
   * @param  string $string the input string
   * @param  int $index position of the character
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string the character at $index or null if the index does not exist
   * @throws OutOfBoundsException if the index does not exist
   */
  public static function charAt(string $string, int $index, string $encoding = null): string {
    $length = static::length($string, $encoding);
    if (($index >= 0 && $length <= $index) || $length < $index) {
      throw new OutOfBoundsException("No character exists at the index: ($index)");
    }
    return \mb_substr($string, $index, 1, static::getEncoding($encoding));
  }

  /**
   * Returns an array consisting of the characters in the string.
   *
   * @param  string $string the input string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return array an array of string chars
   */
  public static function toArray(string $string, string $encoding = null): array {
    $enc = self::getEncoding($encoding);
    $length = static::length($string, $enc);
    $arr = [];
    for ($i = 0; $i < $length; $i += 1) {
      $arr[] = mb_substr($string, $i, 1, $enc);
    }
    return $arr;
  }

  /**
   * Returns the index of the first occurrence of $needle in the string
   * 
   * Returns false if the needle was not found. Accepts an optional offset from 
   * which to begin the search.
   *
   * @param  string $string input string
   * @param  string $needle Substring to look for
   * @param  int $offset Offset from which to search
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return int|bool The occurrence's index if found, otherwise false
   */
  public static function indexOf(string $string, string $needle, int $offset = 0, string $encoding = null) {
    $enc = self::getEncoding($encoding);
    return \mb_strpos($string, $needle, $offset, $enc);
  }

  /**
   * Checks whether the given string is empty
   * 
   * @param  string $string checked string
   * @return boolean true if the string is empty, false otherwise
   */
  public static function isEmpty(string $string): bool {
    return $string === '';
  }

  /**
   * Returns the length of the given string
   * 
   * @param  string $str a string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return int the length of the given string
   */
  public static function length(string $str, string $encoding = null): int {
    return mb_strlen($str, self::getEncoding($encoding));
  }

  /**
   * Checks whether or not the input string contains only alphabetic chars
   * 
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool returns true if the string contains only alphabetic chars, false otherwise.
   */
  public static function isAlpha(string $string, string $encoding = null): bool {
    return self::match($string, '/^[[:alpha:]]*$/', $encoding);
  }

  /**
   * Checks whether or not the input string contains only alphanumeric chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool returns true if the string contains only alphanumeric chars, false otherwise
   */
  public static function isAlphanumeric(string $string, string $encoding = null): bool {
    return self::match($string, '/^[[:alnum:]]*$/', $encoding);
  }

  /**
   * Checks whether or not the input string contains only whitespace chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool returns true if the string contains only whitespace chars, false otherwise
   */
  public static function isBlank(string $string, string $encoding = null): bool {
    return self::match($string, '/^[[:space:]]{1,}$/', $encoding);
  }

  /**
   * Checks whether or not the input string contains only hexadecimal chars
   *
   * @param  string $string checked string
   * @return bool returns true if the string contains only hexadecimal chars, false otherwise
   */
  public static function isHexadecimal(string $string): bool {
    return self::match($string, '/^(#|0x){0,1}[[:xdigit:]]{1,}$/');
  }

  /**
   * Checks whether or not the input string contains only binary chars
   * 
   * @param  string $string checked string
   * @return bool returns true if the string contains only binary chars, false otherwise
   */
  public static function isBinary(string $string): bool {
    return self::match($string, '/^[0-1]+$/');
  }

  /**
   * Checks if the string is JSON
   * 
   * Unlike `json_decode` in PHP 5.x, this method is consistent with PHP 7 and 
   * other JSON parsers, in that an empty string is not considered valid JSON.
   *
   * @param  string $string checked string
   * @return bool true if the string is in JSON format, false otherwise
   */
  public static function isJson(string $string): bool {
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
  }

  /**
   * Perform a case folding on a string
   *
   * @param  string $string the input string
   * @param  int $mode the mode of the conversion. It can be one of `MB_CASE_UPPER`, `MB_CASE_LOWER`, or `MB_CASE_TITLE`.
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string A case folded version of string converted in the way specified by mode
   */
  public static function convertCase(string $string, int $mode, string $encoding = null): string {
    return \mb_convert_case($string, $mode, static::getEncoding($encoding));
  }

  /**
   * Checks the case folding of a string
   *
   * @param  string $string checked string
   * @param  int $mode the mode of the conversion. It can be one of `MB_CASE_UPPER`, `MB_CASE_LOWER`, or `MB_CASE_TITLE`.
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool returns true if the string is converted according to the way specified by mode
   */
  public static function caseIs(string $string, int $mode, string $encoding = null): bool {
    return static::convertCase($string, $mode, $encoding) === $string;
  }

  /**
   * Returns a random string for non cryptographic purposes
   *
   * @param string $charset
   * @param int $length
   * @return string generated random string
   */
  public static function randomize(string $charset = 'abcdefghijklmnopqrstuvwxyz', int $length = 32): string {
    if ($length < 1) {
      // Just return an empty string. Any value < 1 is meaningless.
      return '';
    }

    // Remove duplicate characters from $charset
    // $charset = implode(array_unique(static::toArray($charset)));
    $charArray = array_values(array_unique(static::toArray($charset)));
    $char_max = count($charArray) - 1;
    // This is the maximum index for all of the characters in the string $charset
    // $charset_max = mb_strlen($charset) - 1;
    if ($char_max < 1) {
      // Avoid letting users do: random_str($int, 'a'); -> 'aaaaa...'
      throw new LogicException(
              'random_str - Argument 2 - expected a string that contains at least 2 distinct characters'
      );
    }
    // Now that we have good data, this is the meat of our function:
    $output = '';
    for ($i = 0; $i < $length; ++$i) {
      $r = random_int(0, $char_max);
      $output .= $charArray[$r];
    }
    return $output;
  }

  /**
   * 
   * @param  string|null $encoding
   * @return string
   */
  public static function getEncoding(string $encoding = null): string {
    if ($encoding === null) {
      $encoding = \mb_internal_encoding();
    }
    //echo "current encoding:(".$encoding.")\n";
    return $encoding;
  }

  /**
   * Convert all HTML entities to their applicable characters
   *
   * **Notes:**
   *
   * * Converts both double and single quotes as default
   * * The default value for the encoding parameter is UTF-8 for all PHP versions
   *
   * @param  string $string the input string
   * @param  int $flags a bitmask of one or more of the flags
   * @return string the decoded string
   * $link   http://fi1.php.net/manual/en/function.html-entity-decode.php html_entity_decode (PHP)
   */
  public static function htmlDecode(string $string, int $flags = ENT_COMPAT): string {
    $encoding = mb_detect_encoding($string, 'utf-8');
    return html_entity_decode($string, $flags, $encoding);
  }

  /**
   * Convert all applicable characters to HTML entities
   *
   * **Notes:**
   *
   * * Converts both double and single quotes as default
   * * The default value for the encoding parameter is UTF-8 for all PHP versions
   * * Unlike the native PHP function; this method will not double encode existing html entities
   *
   * @param  string $string the input string
   * @param  int $flags a bitmask of one or more of the flags
   * @return string the encoded string
   * $link   http://php.net/manual/en/function.htmlentities.php htmlentities (PHP)
   */
  public static function htmlEncode(string $string, int $flags = ENT_COMPAT): string {
    $encoding = mb_detect_encoding($string, 'utf-8');
    return htmlentities($string, $flags, $encoding);
  }

}
