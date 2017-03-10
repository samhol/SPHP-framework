<?php

/**
 * Strings.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

/**
 * Utility class for multibyte string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-22
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
    //$regexEncoding = mb_regex_encoding();
    //echo "regexEncoding:($regexEncoding)\n";
    //\mb_regex_encoding(self::getEncoding($encoding));
    // $match = \mb_ereg_match($pattern, $string);
    // echo "regexEncodingNow:($regexEncoding)\n";
    //\mb_regex_encoding($regexEncoding);
    return preg_match($pattern, $string) === 1;
    // return $match === 1;
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
    // echo "pattern:$pattern\n";
    $result = \mb_ereg_replace($pattern, $replacement, $string, $option);
    mb_regex_encoding($regexEncoding);
    return $result;
  }

  /**
   * Replaces all occurrences of $search in $str by $replacement
   *
   * @param  string $search      The needle to search for
   * @param  string $replacement The string to replace with
   * @return string the resulting string after the replacements
   */
  public static function replace($string, $search, $replacement) {
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
  public static function reverse($string, $encoding = null) {
    $strLength = static::length($string, $encoding);
    $reversed = '';
    for ($i = $strLength - 1; $i >= 0; $i--) {
      $reversed .= \mb_substr($string, $i, 1, static::getEncoding($encoding));
    }
    return $reversed;
  }

  /**
   * Splits the string with the provided regular expression
   * 
   * Returns an array of strings. An optional integer $limit will truncate the
   * results.
   *
   * @param  string $pattern the regex with which to split the string
   * @param  int $limit optional maximum number of results to return
   * @return string[] an array of strings
   */
  public static function split($string, $pattern, $limit = -1, $encoding = null) {
    if ($limit === 0) {
      return array();
    }
    $regexEncoding = mb_regex_encoding();
    mb_regex_encoding(self::getEncoding($encoding));
    $array = \mb_split($pattern, $string, $limit);
    mb_regex_encoding($regexEncoding);
    return $array;
  }

  /**
   * Splits the input in newlines and carriage returns to an array of strings
   *
   * @param  string $string the input string
   * @param  string $encoding the encoding parameter is the character encoding.
   *         Defaults to `mb_internal_encoding()`
   * @return string[] lines from input string as an array of strings
   */
  public static function lines($string, $encoding = null) {
    $array = static::split($string, '[\r\n]{1,2}', -1, $encoding);
    return $array;
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
  public static function trimLeft($string, $charMask = null, $encoding = null) {
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
  public static function trimRight($string, $charMask = null, $encoding = null) {
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
  public static function collapseWhitespace($string, $encoding = null) {
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
   * @param  boolean $caseSensitive Whether or not to enforce case-sensitivity
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
   * @param  string|null $encoding the character encoding parameter;
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
   * @param  string|null $encoding the character encoding parameter;
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
  public static function indexOf($string, $needle, $offset = 0, $encoding = null) {
    $enc = self::getEncoding($encoding);
    return \mb_strpos($string, (string) $needle, (int) $offset, $enc);
  }

  /**
   * Returns the substring between $start and $end, if found, or an empty
   * string. An optional offset may be supplied from which to begin the
   * search for the start string.
   *
   * @param  string $string input string
   * @param  string $start  Delimiter marking the start of the substring
   * @param  string $end Delimiter marketing the end of the substring
   * @param  int $offset Index from which to begin the search
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string Object whose $str has been converted to an URL slug
   */
  public static function between($string, $start, $end, $offset = 0, $encoding = null) {
    $enc = self::getEncoding($encoding);
    $startIndex = static::indexOf($string, $start, $offset, $encoding);
    if ($startIndex === false) {
      return $string;
    }
    $substrIndex = $startIndex + \mb_strlen($start, $enc);
    $endIndex = static::indexOf($string, $end, $substrIndex, $encoding);
    if ($endIndex === false) {
      return "";
    }
    return static::substr($string, $substrIndex, $endIndex - $substrIndex, $enc);
  }

  /**
   * Checks whether the given string is empty
   * 
   * @param  string $string checked string
   * @return boolean true if the string is empty, false otherwise
   */
  public static function isEmpty($string) {
    return empty($string) && $string !== "0" && $string !== 0 && $string !== 0.0;
  }

  /**
   * Returns the length of the given string
   * 
   * @param  string $str a string
   * @param  string|null $encoding the character encoding parameter;
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
   * @param  string|null $encoding the character encoding parameter;
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
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only alphabetic chars, false otherwise.
   */
  public static function isAlpha($string, $encoding = null) {
    return self::match($string, '/^[[:alpha:]]*$/', $encoding);
  }

  /**
   * Checks whether or not the input string contains only alphanumeric chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only alphanumeric chars, false otherwise.
   */
  public static function isAlphanumeric($string, $encoding = null) {
    return self::match($string, '/^[[:alnum:]]*$/', $encoding);
  }

  /**
   * Checks whether or not the input string contains only whitespace chars
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
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
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only hexadecimal chars, false otherwise.
   */
  public static function isHexadecimal($string, $encoding = null) {
    return self::match($string, '/^[[:xdigit:]]*$/', $encoding);
  }

  /**
   * Checks if the string is JSON
   * 
   * Unlike json_decode in PHP 5.x, this method is consistent with PHP 7 and 
   * other JSON parsers, in that an empty string is not considered valid JSON.
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool true if the string is JSON, false otherwise
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
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only upper chars, false otherwise.
   */
  public static function isUpperCase($string, $encoding = null) {
    return static::toUpperCase($string, $encoding) == $string;
  }

  /**
   * Converts all characters in the string to uppercase
   *
   * @param  string $string the input string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string input string with all characters being uppercase
   */
  public static function toUpperCase($string, $encoding = null) {
    return \mb_strtoupper($string, static::getEncoding($encoding));
  }

  /**
   * Checks whether or not the input string contains only lower case characters
   *
   * @param  string $string checked string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return bool Returns true if the string contains only lower chars, false otherwise.
   */
  public static function isLowerCase($string, $encoding = null) {
    return static::toLowerCase($string, $encoding) == $string;
  }

  /**
   * Converts all characters in the string to uppercase
   *
   * @param  string $string the input string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string input string with all characters being uppercase
   */
  public static function toLowerCase($string, $encoding = null) {
    return \mb_strtolower($string, static::getEncoding($encoding));
  }

  /**
   * Checks whether or not the input string is serialized
   *
   * @param  string $string checked string
   * @return bool Returns true if the string is serialized, false otherwise.
   */
  public static function isSerialized($string) {
    return $string === 'b:0;' || @unserialize($string) !== false;
  }

  /**
   * Returns a random string for non cryptographic purposes
   *
   * @param  int $length the length of the string
   * @return string generated random string
   */
  public static function random($length = 16) {
    return str_shuffle(substr(str_repeat(md5(mt_rand()), 2 + $length / 32), 0, $length));
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
    //echo "current encoding:(".$encoding.")\n";
    return $encoding;
  }

  /**
   * Wraps the string by placing the given wrappers at the both ends of the string
   *
   * @param  string $string input string
   * @param  string $before string's start wrapper
   * @param  string $after string's end wrapper
   * @return string wrapped string
   */
  public static function surround($string, $before = "'", $after = null) {
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
    return str_replace('\t', $spaces, $string);
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
   * Converts the first character of each word in the string to uppercase
   *
   * @param  string $string the input string
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string input string with all characters being title-cased
   */
  public static function toTitleCase($string, $encoding = null) {
    return \mb_convert_case($string, \MB_CASE_TITLE, static::getEncoding($encoding));
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
      if (method_exists($var, '__toString')) {
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

  /**
   * 
   * @param  string $format
   * @param  scalar[] $data
   * @return string   
   */
  public static function vsprintf($format, array $data) {
    preg_match_all(
            '/ (?<!%) % ( (?: [[:alpha:]_-][[:alnum:]_-]* | ([-+])? [0-9]+ (?(2) (?:\.[0-9]+)? | \.[0-9]+ ) ) ) \$ [-+]? \'? .? -? [0-9]* (\.[0-9]+)? \w/x'
            , $format, $match, PREG_SET_ORDER | PREG_OFFSET_CAPTURE);
    $offset = 0;
    $keys = array_keys($data);
    foreach ($match as &$value) {
      if (( $key = array_search($value[1][0], $keys, TRUE) ) !== FALSE || ( is_numeric($value[1][0]) && ( $key = array_search((int) $value[1][0], $keys, TRUE) ) !== FALSE)) {
        $len = strlen($value[1][0]);
        $format = substr_replace($format, 1 + $key, $offset + $value[1][1], $len);
        $offset -= $len - strlen(1 + $key);
      }
    }
    return vsprintf($format, $data);
  }

}
