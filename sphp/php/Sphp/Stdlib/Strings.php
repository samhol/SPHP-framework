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

use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\LogicException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Utility class for multibyte string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
final class Strings {

  public const TYPE_ALPHA = '/^[[:alpha:]]*$/';
  public const TYPE_ALPHANUM = '/^[[:alnum:]]*$/';
  public const TYPE_BINARY = '/^(0b)?[0-1]{1,}$/';

  /**
   * An octal number is a number that consists of the digits 0 to 7. The number 
   * must either have at least one leading zero, or it must be prefixed with 0o
   */
  public const TYPE_OCTAL = '/^(0o|0){1}[0-7]*$/';
  public const TYPE_HEX = '/^(#|0x){0,1}[[:xdigit:]]{1,}$/';
  public const TYPE_BLANK = '/^[[:space:]]{1,}$/';
  public const TYPE_NUM = '"/^\\d+$/"';
  public const CASE_UPPER = MB_CASE_UPPER;
  public const CASE_LOWER = MB_CASE_LOWER;
  public const CASE_TITLE = MB_CASE_TITLE;

  /**
   * Performs a regular expression match
   *
   * @param  string $string the input string
   * @param  string $pattern the pattern to search for, as a string
   * @return bool true if string matches to the regular expression, false otherwise
   */
  public static function match(string $string, string $pattern): bool {
    $result = preg_match($pattern, $string) === 1;
    return $result;
  }

  /**
   * Replaces a regular expression with multibyte support
   *
   * @param  string $string the input string
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $replacement the replacement text.
   * @param  string $option
   * @param  string|null $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string|boolean the resultant string on success, or false on error
   * @link   https://www.php.net/manual/en/function.mb-ereg-replace.php
   */
  public static function regexReplace(string $string, string $pattern, string $replacement, ?string $option = null, string|null $encoding = null): string {
    $regexEncoding = mb_regex_encoding();
    mb_regex_encoding($encoding);
    if ($option === null) {
      //  $option = 'msr';
    }
    // echo "pattern:$pattern\n";
    $result = \mb_ereg_replace($pattern, $replacement, $string, $option);
    mb_regex_encoding($regexEncoding);
    return $result;
  }

  /**
   * 
   * @param  string $string
   * @param  string $replace
   * @param  int $offset
   * @param  int $length
   * @param  string|null $encoding
   * @return string
   */
  public static function substringReplace(string $string, string $replace, int $offset, int $length, string|null $encoding = null): string {
    return mb_substr($string, 0, $offset, $encoding) . $replace . mb_substr($string, $offset + $length, null, $encoding);
  }

  /**
   * Returns a reversed string
   *
   * @param  string $string the input string
   * @param  string|null $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string string reversed string 
   */
  public static function reverse(string $string, ?string $encoding = null): string {
    $strLength = mb_strlen($string, $encoding);
    $reversed = '';
    for ($i = $strLength - 1; $i >= 0; $i--) {
      $reversed .= \mb_substr($string, $i, 1, $encoding);
    }
    return $reversed;
  }

  /**
   * Returns a string with whitespace removed from the start and end of the string 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string $string the input string
   * @param  string|null  $charMask optional string of characters to strip
   * @param  string|null $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string trimmed string 
   */
  public static function trim(string $string, ?string $charMask = null, ?string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+|[$chars]+$", '', 'msr', $encoding);
  }

  /**
   * Returns a string with whitespace removed from the start of the string
   * 
   * Supports the removal of unicode whitespace. Accepts an optional
   * string of characters to strip instead of the defaults.
   *
   * @param  string $string the input string
   * @param  string|null $charMask optional string of characters to strip
   * @param  string|null $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string trimmed string 
   */
  public static function trimLeft(string $string, ?string $charMask = null, ?string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+", '', 'msr', $encoding);
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
  public static function trimRight(string $string, string $charMask = null, ?string $encoding = null): string {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "[$chars]+$", '', 'msr', $encoding);
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
  public static function collapseWhitespace(string $string, ?string $encoding = null): string {
    $collapsed = static::regexReplace($string, '[[:space:]]+', ' ', 'msr', $encoding);
    return static::trim($collapsed, null, $encoding);
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
        if (!str_contains($haystack, (string) $needle)) {
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
   * @return bool whether the string contains any of the needles
   */
  public static function containsAny(string $haystack, array $needles): bool {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if (str_contains($haystack, (string) $needle)) {
          return true;
        }
      }
      return false;
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
  public static function charAt(string $string, int $index, ?string $encoding = null): string {
    $length = mb_strlen($string, $encoding);
    if ($index < 0 || $length < $index) {
      throw new OutOfBoundsException("No character exists at the index: ($index)");
    }
    return \mb_substr($string, $index, 1, $encoding);
  }

  /**
   * Returns an array consisting of the characters in the string.
   *
   * @param  string $string the input string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return array an array of string chars
   */
  public static function toArray(string $string, ?string $encoding = null): array {
    return mb_str_split($string, 1, $encoding);
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
  public static function typeIs(string $string, int|string $type): bool {
    $out = false;
    if (is_string($type)) {
      $out = self::match($string, $type);
    } else {
      $out = mb_convert_case($string, $type) === $string;
    }
    return $out;
  }

  /**
   * Returns a random string for non cryptographic purposes
   *
   * @param  string $charset
   * @param  int $length
   * @return string generated random string
   * @throws InvalidArgumentException
   * @throws LogicException
   */
  public static function randomize(string $charset = 'abcdefghijklmnopqrstuvwxyz', int $length = 32): string {
    if ($length < 1) {
      throw new InvalidArgumentException('Cannot generate zero length random string');
    }
    $input_length = strlen($charset);
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
      $random_character = $charset[mt_rand(0, $input_length - 1)];
      $random_string .= $random_character;
    }
    return $random_string;
  }

}
