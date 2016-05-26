<?php

/**
 * Strings.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types;

/**
 * Utility class for PHP string operations
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-22
 * @version 2.2.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Strings {

  /**
   * Perform a regular expression match.
   *
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $str the input string
   * @return boolean true if string matches to the regular expression, false otherwise
   */
  public static function match($pattern, $str) {
    return preg_match($pattern, $str) === 1;
  }

  /**
   * Perform a regular expression match.
   *
   * @param  string $pattern the pattern to search for, as a string
   * @param  string $str the input string
   * @return boolean true if string matches to the regular expression, false otherwise
   */
  public static function replace($pattern, $replacement, $subject, $limit = -1) {
    return preg_replace($pattern, $replacement, $subject, $limit);
  }

  /**
   * Tests whether the string contains the substring or not
   *
   * @param  string $needle the substring to search for
   * @param  string $haystack the string being checked
   * @return boolean true if needle was found from the haystack string, false otherwise
   */
  public static function contains($needle, $haystack) {
    return mb_strpos($haystack, $needle) !== false;
  }

  /**
   * Checks whether a $haystack string starts with any of the given needles
   *
   * @assert ("abc", "a") == true
   * @assert ("abc", "ab") == true
   * @assert ("abc", ["ab", "a"]) == true
   * @assert ("abc", "") == true
   * @assert ("", "a") == false
   * @assert ("", "0") == false
   * @param  string $haystack the string being checked
   * @param  string|string[] $choices the starts to compare with
   * @param  string $encoding the encoding parameter is the character encoding. Defaults to `UTF-8`
   * @return boolean true if the haystack starts with any of the given needles
   */
  public static function startsWith($haystack, $choices, $encoding = "UTF-8") {
    if (is_array($choices)) {
      foreach ($choices as $choice) {
        if (self::startsWith($haystack, $choice)) {
          return true;
        }
      }
    } else {
      return $choices === "" || mb_strrpos($haystack, $choices, 0, $encoding) === 0;
    }
  }

  /**
   * Checks whether a haystack string ends with any of the given needles
   *
   * @param  string $haystack the string being checked
   * @param  string|string[] $choices the endings to compare with
   * @param  string $encoding the encoding parameter is the character encoding. Defaults to `UTF-8`
   * @return boolean true if the haystack ends with any of the given needles
   */
  public static function endsWith($haystack, $choices, $encoding = "UTF-8") {
    if (is_array($choices)) {
      foreach ($choices as $choice) {
        if (self::endsWith($haystack, $choice, $encoding)) {
          return true;
        }
      }
      return false;
    } else if ($choices === "") {
      return true;
    } else {
      return mb_substr($haystack, -mb_strlen($choices, $encoding), null, $encoding) === $choices;
    }
  }

  /**
   * Checks whether the given strings are not empty.
   *
   * **Important:** The following strings are considered as empty.
   * 
   * 1. `null`
   * 2. ""
   * 3. strings containing only spaces, linebreaks, tabs
   * 
   * @param  string|string[] $str checked strings
   * @return boolean true if the strings are not empty, false otherwise
   */
  public static function notEmpty($str) {
    if (is_array($str)) {
      foreach ($str as $s) {
        if (!self::notEmpty($s)) {
          return false;
        }
      }
    }
    return (isset($str) && self::length($str) > 0 && !self::match("/^[ \n\r\t]*$/", $str));
  }

  /**
   * Checks whether the given strings are empty

   * **Important:** The following strings are considered as empty.
   * 
   * 1. `null`
   * 2. ""
   * 3. strings containing only spaces, linebreaks, tabs
   * 
   * @param  string|string[] $str checked strings
   * @return boolean true if the strings are empty, false otherwise
   */
  public static function isEmpty($str) {
    return !self::notEmpty($str);
  }

  /**
   * Returns the length of the given string
   * 
   * @param  string $str a string
   * @return int the length of the given string
   */
  public static function length($str) {
    return mb_strlen($str, "UTF-8");
  }

  /**
   * Determines if the string length is on a given closed interval
   *
   * @assert ("abc", 0, 1) == false
   * @assert ("abc", 0, 3) == true
   * @assert ("abc", 3, 3) == true
   * @param  string $str checked string
   * @param  int $lower lower limit
   * @param  int $upper upper limit
   * @return boolean true if the string length is on a given closed interval, false otherwise.
   */
  public static function lengthBetween($str, $lower, $upper) {
    $length = self::length($str);
    return ($lower <= $length && $length <= $upper);
  }

  /**
   * Ordinalize an integer (in english)
   *
   * @param  scalar $num an integer to ordinalize
   * @return string ordinalize integer (in english)
   */
  public static function ordinalize($num) {
    $suff = 'th';
    if (!in_array(($num % 100), [11, 12, 13])) {
      switch ($num % 10) {
        case 1: $suff = 'st';
          break;
        case 2: $suff = 'nd';
          break;
        case 3: $suff = 'rd';
          break;
      }
      return "{$num}{$suff}";
    }
    return "{$num}{$suff}";
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
  public static function htmlentities($string, $flags = ENT_QUOTES, $encoding = 'UTF-8') {
    return htmlentities($string, $flags, $encoding, false);
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
  public static function htmlEntityDecode($string, $flags = ENT_QUOTES, $encoding = 'UTF-8') {
    return html_entity_decode($string, $flags, $encoding);
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
   * Forces a string representation from any type of input parameter
   *
   * @assert (null) === ""
   * @assert (0) === "0"
   * @assert (true) == "1"
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
