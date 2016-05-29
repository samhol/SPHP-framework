<?php

/**
 * Strings.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

/**
 * Utility class for multibyte string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-22
 * @version 2.2.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Strings {

  /**
   * Performs a regular expression match
   *
   * @param  string $string the input string
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return boolean true if string matches to the regular expression, false otherwise
   */
  public static function match($string, $pattern, $encoding = null) {
    $regexEncoding = mb_regex_encoding();
    \mb_regex_encoding(self::getEncoding($encoding));
    //$match = \mb_ereg($pattern, $string);
    
    \mb_regex_encoding($regexEncoding);
    return preg_match($pattern, $string) === 1;
    return $match === 1;
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
  public static function regexReplace($string, $pattern, $replacement, $option = null, $encoding = null) {
    $regexEncoding = mb_regex_encoding();
    mb_regex_encoding(self::getEncoding($encoding));
    if ($option === null) {
      $option = 'msr';
    }
    $result = \mb_ereg_replace($pattern, $replacement, $string, $option);
    mb_regex_encoding($regexEncoding);
    return $result;
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
  public static function trim($string, $charMask = null, $encoding = null) {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+|[$chars]+\$", '', 'msr', self::getEncoding($encoding));
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
  public static function trimLeft($string, $charMask = null, $encoding = null) {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "^[$chars]+", '', 'msr', self::getEncoding($encoding));
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
  public static function trimRight($string, $charMask = null, $encoding = null) {
    $chars = ($charMask) ? preg_quote($charMask) : '[:space:]';
    return static::regexReplace($string, "[$chars]+\$", '', 'msr', self::getEncoding($encoding));
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
  public static function contains($haystack, $needle, $encoding = null) {
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
  public static function containsAll($haystack, array $needles, $encoding = null) {
    if (empty($needles)) {
      return false;
    } else {
      foreach ($needles as $needle) {
        if (!self::contains($haystack, $needle, $encoding)) {
          return false;
        }
      }
      return true;
    }
  }

  /**
   * Returns the number of occurrences of $substring in the given string.
   * By default, the comparison is case-sensitive, but can be made insensitive
   * by setting $caseSensitive to false.
   *
   * @param  string $string the string being checked
   * @param  string $substring     The substring to search for
   * @param  bool   $caseSensitive Whether or not to enforce case-sensitivity
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return int    The number of $substring occurrences
   */
  public static function countSubstr($string, $substring, $caseSensitive = true, $encoding = null) {
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
  public static function startsWith($haystack, $needle, $encoding = null) {
    return $needle === "" || mb_strrpos($haystack, $needle, 0, self::getEncoding($encoding)) === 0;
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
  public static function endsWith($haystack, $needle, $encoding = null) {
    if ($needle === "") {
      return true;
    } else {
      $enc = self::getEncoding($encoding);
      return \mb_substr($haystack, -\mb_strlen($needle, $enc), null, $enc) === $needle;
    }
  }

  /**
   * Returns the character at $index, with indexes starting at 0
   *
   * @param  string $string the input string
   * @param  int $index position of the character
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return string|null the character at $index or null if the index does not exist
   */
  public static function charAt($string, $index, $encoding = null) {
    $length = static::length($string, $encoding);
    $result = null;
    if ($index >= 0 && $length > $index) {
      $result = mb_substr($string, $index, 1, self::getEncoding($encoding));
    }
    return $result;
  }

  /**
   * Returns an array consisting of the characters in the string.
   *
   * @param  string $string the input string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return array an array of string chars
   */
  public static function chars($string, $encoding = null) {
    $enc = self::getEncoding($encoding);
    $length = static::length($string, $enc);
    $chars = array();
    for ($i = 0; $i < $length; $i++) {
      $chars[] = mb_substr($string, $i, 1, $enc);
    }
    return $chars;
  }

  /**
   * Checks whether the given string is not empty
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return boolean true if the string is not empty, false otherwise
   */
  public static function notEmpty($string, $encoding = null) {
    return self::length($string, self::getEncoding($encoding)) > 0;
  }

  /**
   * Checks whether the given string is empty
   * 
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return boolean true if the string is empty, false otherwise
   */
  public static function isEmpty($string, $encoding = null) {
    return !self::notEmpty($string, self::getEncoding($encoding));
  }

  /**
   * Returns the length of the given string
   * 
   * @param  string $str a string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return int the length of the given string
   */
  public static function length($str, $encoding = null) {
    return mb_strlen($str, self::getEncoding($encoding));
  }

  /**
   * Determines if the string length is on a given closed interval
   *
   * @param  string $str checked string
   * @param  int $lower lower limit
   * @param  int $upper upper limit
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return boolean true if the string length is on a given closed interval, false otherwise.
   */
  public static function lengthBetween($str, $lower, $upper, $encoding = null) {
    $length = self::length($str, $encoding);
    return ($lower <= $length && $length <= $upper);
  }

  /**
   * Checks whether or not the input string contains only alphabetic chars
   * 
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only alphabetic chars, false otherwise.
   */
  public static function isAlpha($string, $encoding = null) {
    return self::match($string, '^[[:alpha:]]*$', $encoding);
  }

  /**
   * Checks whether or not the input string contains only alphanumeric chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only alphanumeric chars, false otherwise.
   */
  public static function isAlphanumeric($string, $encoding = null) {
    return self::match($string, '^[[:alnum:]]*$', $encoding);
  }

  /**
   * Checks whether or not the input string contains only whitespace chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only whitespace chars, false otherwise.
   */
  public static function isBlank($string, $encoding = null) {
    return self::match($string, '^[[:space:]]*$', $encoding);
  }

  /**
   * Checks whether or not the input string contains only hexadecimal chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only hexadecimal chars, false otherwise.
   */
  public static function isHexadecimal($string, $encoding = null) {
    return self::match($string, '^[[:xdigit:]]*$', $encoding);
  }

  /**
   * Returns true if the string is JSON, false otherwise. Unlike json_decode
   * in PHP 5.x, this method is consistent with PHP 7 and other JSON parsers,
   * in that an empty string is not considered valid JSON.
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Whether or not $str is JSON
   */
  public static function isJson($string, $encoding = null) {
    if (!static::length($string, $encoding)) {
      return false;
    }
    json_decode($string);
    return (json_last_error() === JSON_ERROR_NONE);
  }

  /**
   * Checks whether or not the input string contains only upper case characters
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only upper chars, false otherwise.
   */
  public static function isUpperCase($string, $encoding = null) {
    return self::match($string, '^[[:upper:]]*$', $encoding);
  }

  /**
   * Checks whether or not the input string contains only lower case characters
   *
   * @param  string $string checked string
   * @param  string|null $encoding the encoding parameter is the character encoding. 
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only lower chars, false otherwise.
   */
  public static function isLowerCase($string, $encoding = null) {
    return self::match($string, '^[[:lower:]]*$', $encoding);
  }

  /**
   * Checks whether or not the input string is serialized
   * Returns true if the string is serialized, false otherwise.
   *
   * @param  string $string checked string
   * @return bool Returns true if the string is serialized, false otherwise.
   */
  public static function isSerialized($string) {
    return $string === 'b:0;' || @unserialize($string) !== false;
  }

  /**
   * Ordinalize an integer (in english)
   *
   * @param  scalar $num an integer to ordinalize
   * @return string ordinalize integer (in english)
   */
  public static function ordinalize($num) {
    $suff = 'th';
    $prefix = "";
    if ((int) $num < 0) {
      $prefix = "-";
    }
    $int = abs((int) $num);
    if (!in_array(($int % 100), [11, 12, 13])) {
      switch ($int % 10) {
        case 1: $suff = 'st';
          break;
        case 2: $suff = 'nd';
          break;
        case 3: $suff = 'rd';
          break;
      }
    }
    return "{$prefix}{$int}{$suff}";
  }

  /**
   * Converts the filesize (in bits) to bytes
   *
   * @param  int|string $filesize file size in bits
   * @return string filesize in bytes
   */
  public static function generateFilesizeString($filesize) {
    if (is_numeric($filesize)) {
      $decr = 1024;
      $step = 0;
      $prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
      while (($filesize / $decr) > 0.9) {
        $filesize = $filesize / $decr;
        $step++;
      }
      return round($filesize, 2) . ' ' . $prefix[$step];
    } else {
      return 'NaN';
    }
  }

  /**
   * Returns a random string for non cryptographic purposes
   *
   * @param  int $length the length of the string
   * @return string generated random string
   */
  public static function generateRandomString($length = 16) {
    return str_shuffle(substr(str_repeat(md5(mt_rand()), 2 + $length / 32), 0, $length));
  }

  /**
   * Removes redundant zeroes fron the decimal number
   *
   * @param  string|float $decimal the decimal number
   * @return string cleaned decimal number
   */
  public static function cleanDecimal($decimal) {
    return trim(trim($decimal, '0'), '.');
  }

  /**
   * 
   * @param  string|null $encoding
   * @return string
   */
  public static function getEncoding($encoding = null) {
    if ($encoding === null) {
      $encoding = \mb_internal_encoding();
    }
    return $encoding;
  }

  /**
   * Wraps the string by placing the given wrappers at the both ends of the string
   *
   * @param  string $string wrapped string
   * @param  string $before string's start wrapper
   * @param  string $after string's end wrapper
   * @return string wrapped string
   */
  public static function wrap($string, $before = "'", $after = null) {
    if ($after === null) {
      $after = $before;
    }
    return $before . $string . $after;
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
   * @param  string $encoding defines encoding used in conversion
   * @return string the decoded string
   * $link   http://fi1.php.net/manual/en/function.html-entity-decode.php html_entity_decode (PHP)
   */
  public static function htmlDecode($string, $flags = ENT_QUOTES, $encoding = null) {
    return html_entity_decode($string, $flags, static::getEncoding($encoding));
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
   * @param  string $encoding defines encoding used in conversion
   * @return string the encoded string
   * $link   http://php.net/manual/en/function.htmlentities.php htmlentities (PHP)
   */
  public static function htmlEncode($string, $flags = ENT_COMPAT, $encoding = null) {
    return htmlentities($string, $flags, static::getEncoding($encoding));
  }

  /**
   * Executes a PHP script and returns the result as a parsed Markdown string
   *
   * @param  string $markdown the markdown string
   * @return string the result of the script execution
   */
  public static function parseMarkdown($markdown) {
    return (new \ParsedownExtra())->text(static::toString($markdown));
  }

  /**
   * Converts each tab in the string to given number of spaces
   * 
   * By default, each tab is converted to `4` consecutive spaces.
   *
   * @param  string $string the input string
   * @param  int $tabLength Number of spaces to replace each tab with
   * @return string A string whose tabs are switched to spaces
   */
  public static function toSpaces($string, $tabLength = 4) {
    $spaces = str_repeat(' ', $tabLength);
    return str_replace("\t", $spaces, $string);
  }

  /**
   * Converts each occurrence of given consecutive number of spaces  to a tab
   * 
   * By default, each `4` consecutive spaces are converted to a tab.
   *
   * @param  string $string the input string
   * @param  int $tabLength Number of spaces to replace with a tab
   * @return string A string whose spaces are switched to tabs
   */
  public static function toTabs($string, $tabLength = 4) {
    $spaces = str_repeat(' ', $tabLength);
    return str_replace($spaces, "\t", $string);
  }

  /**
   * Forces a string representation from any type of input parameter
   *
   * @param  mixed $var input parameter
   * @return string a string representation of the input parameter
   */
  public static function toString($var) {
    if (is_array($var)) {
      return print_r($var, true);
    } else if (is_object($var)) {
      if (method_exists($var, "__toString")) {
        return $var->__toString();
      } else {
        return get_class($var);
      }
    }
    if (is_float($var)) {
      return sprintf('%0.0f', $var);
    } else {
      return strval($var);
    }
  }

}
