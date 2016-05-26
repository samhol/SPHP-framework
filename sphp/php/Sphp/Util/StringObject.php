<?php

/**
 * StringObject.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Util;


/**
 * Object oriented representation of a PHP string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StringObject implements \IteratorAggregate, \Countable {

  /**
   * the string in UTF-8 format
   *
   * @var string 
   */
  private $string;

  /**
   * Constructs a new {@link self} object
   * 
   * @param  mixed $string the wrapped value
   * @param  string $encoding the original encoding of the string
   */
  public function __construct($string, $encoding = "UTF-8") {
    $this->string = self::parseStringValue($string, $encoding);
  }

  /**
   * Perform a regular expression match.
   *
   * @param  string $pattern the pattern to search for, as a string
   * @return boolean true if the string matches to the regular expression, false otherwise
   */
  public function match($pattern) {
    return preg_match($pattern, $this->string) === 1;
  }

  /**
   * Tests whether the string contains the substring or not
   *
   * @param  string|String $needle the substring to search for
   * @return boolean true if needle was found from the haystack string, false otherwise
   */
  public function contains($needle) {
    return strpos($this->string, self::parseStringValue($needle)) !== false;
  }

  /**
   * Checks whether the string starts with the given prefix
   *
   * @param  string|String $start the start to compare with
   * @return boolean true if the string starts with the given prefix
   */
  public function startsWith($start) {
    $needle = self::parseStringValue($start);
    return $needle === "" || mb_strrpos($this->string, $needle, 0, "UTF-8") === 0;
  }

  /**
   * Checks whether a haystack string ends with any of the given needles
   *
   * @param  string|String $end the endings to compare with
   * @return boolean true if the haystack ends with any of the given needles
   */
  public function endsWith($end) {
    $choices = new String($end);
    $the = clone $this;
    return $choices->equals("") || $the->subString(-$choices->length()) === $choices;
  }

  /**
   * Checks whether the string is not empty
   *
   * @return boolean true if the string is not empty, false otherwise
   */
  public function notEmpty() {
    return $this->count() > 0 && !$this->match("/^[ \n\r\t]*$/");
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
   * Returns the length of the string
   * 
   * @return int the length of the string
   */
  public function count() {
    return mb_strlen($this->string, "utf-8");
  }

  /**
   * Returns the length of the string
   * 
   * @return int the length of the string
   * @uses    self::count()
   */
  public function length() {
    return $this->count();
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
   * Wraps the string object by placing the given wrappers at the both ends of the string
   *
   * @param  string|String $pre string's start wrapper
   * @param  string|String|null $post string's end wrapper or null if the $pre is used
   * @return self for PHP Method Chaining
   */
  public function wrap($pre, $post = null) {
    $prefix = self::parseStringValue($pre);
    if ($post !== null) {
      $postfix = self::parseStringValue($post);
    } else {
      $postfix = $prefix;
    }
    return new String($prefix . $this->string . $postfix);
  }

  /**
   * Returns the portion of string specified by the start and length parameters
   * 
   * @param  int $start position of first character to use
   * @param  int|null $length maximum number of characters to use. If omitted or 
   *         null is passed, extract all characters to the end of the string.
   * @return String a new string that is a substring of this string
   * 
   */
  public function subString($start, $length = null) {
    $string = mb_substr($this->string, $start, $length, "UTF-8");
    return new String($string);
  }

  /**
   * Strip whitespace (or other characters) from the beginning of a string
   * 
   * Without the $charmask parameter these characters will be stripped:
   * 
   * * " " (ASCII 32 (0x20)), an ordinary space.
   * * "\t" (ASCII 9 (0x09)), a tab.
   * * "\n" (ASCII 10 (0x0A)), a new line (line feed).
   * * "\r" (ASCII 13 (0x0D)), a carriage return.
   * * "\0" (ASCII 0 (0x00)), the NUL-byte.
   * * "\x0B" (ASCII 11 (0x0B)), a vertical tab.
   * 
   * @param null|string $charmask
   * @return self for PHP Method Chaining
   */
  public function ltrim($charmask = null) {
    if ($charmask !== null) {
      $this->string = ltrim($this->string, $charmask);
    } else {
      $this->string = ltrim($this->string);
    }
    return $this;
  }

  /**
   * Strip whitespace (or other characters) from the end of a string
   * 
   * Without the $charmask parameter these characters will be stripped:
   * 
   * * " " (ASCII 32 (0x20)), an ordinary space.
   * * "\t" (ASCII 9 (0x09)), a tab.
   * * "\n" (ASCII 10 (0x0A)), a new line (line feed).
   * * "\r" (ASCII 13 (0x0D)), a carriage return.
   * * "\0" (ASCII 0 (0x00)), the NUL-byte.
   * * "\x0B" (ASCII 11 (0x0B)), a vertical tab.
   * 
   * @param  null|string $charmask characters to be stripped
   * @return self for PHP Method Chaining
   * @see    http://php.net/manual/en/function.trim.php
   */
  public function rtrim($charmask = null) {
    if ($charmask !== null) {
      $this->string = rtrim($this->string, $charmask);
    } else {
      $this->string = rtrim($this->string);
    }
    return $this;
  }

  /**
   * Strips whitespace (or other characters) from the beginning and end of the string
   * 
   * Without the $charmask parameter these characters will be stripped:
   * 
   * * " " (ASCII 32 (0x20)), an ordinary space.
   * * "\t" (ASCII 9 (0x09)), a tab.
   * * "\n" (ASCII 10 (0x0A)), a new line (line feed).
   * * "\r" (ASCII 13 (0x0D)), a carriage return.
   * * "\0" (ASCII 0 (0x00)), the NUL-byte.
   * * "\x0B" (ASCII 11 (0x0B)), a vertical tab.
   * 
   * @param  null|string $charmask characters to be stripped
   * @return self for PHP Method Chaining
   * @see    http://php.net/manual/en/function.trim.php
   */
  public function trim($charmask = null) {
    if ($charmask !== null) {
      $this->string = trim($this->string, $charmask);
    } else {
      $this->string = trim($this->string);
    }
    return $this;
  }

  /**
   * Replace all occurrences of the search string with the replacement string
   * 
   * **IMPORTANT:** 
   * 
   * 1. For both the $search and the $replace an array may be used to designate 
   *    multiple values.
   * 2. If there is no need for fancy replacing rules (like regular expressions)
   * 
   * @param  string|string[] $search the needle being searched for
   * @param  string|string[] $replace the replacement value that replaces found matches
   * @param  int|null $count if passed, this will be set to the number of replacements performed
   * @return self for PHP Method Chaining
   * @see    http://php.net/str_replace
   */
  public function replace($search, $replace, $count = null) {
    if ($count !== null) {
      $this->string = str_replace($search, $replace, $this->string, $count);
    } else {
      $this->string = str_replace($search, $replace, $this->string);
    }
    return $this;
  }

  /**
   * Strips HTML and PHP tags from the string
   * 
   * @param  null|string $allowableTags optional parameter to specify tags which should not be stripped
   * @return self for PHP Method Chaining
   * @see    http://php.net/manual/en/function.strip-tags.php
   */
  public function stripTags($allowableTags = null) {
    if ($allowableTags !== null) {
      $this->string = strip_tags($this->string, $allowableTags);
    } else {
      $this->string = strip_tags($this->string);
    }
    return $this;
  }

  /**
   * URL-encodes the string according to RFC 3986
   * 
   * @return self for PHP Method Chaining
   * @uses   http://php.net/manual/en/function.rawurlencode.php
   */
  public function rawurlencode() {
    $this->string = rawurlencode($this->string);
    return $this;
  }

  /**
   * Returns the string representation of the object
   *
   * @return string a string representation of the object
   */
  public function __toString() {
    return $this->string;
  }

  /**
   * Determines whether the specified object is equal to this object
   *
   *  **IMPORTANT:** `$string` equals only if: 
   * 
   * 1. its type is either {@link self} or PHP string
   * 2. its value is equal to the value of this {@link self} object
   * 
   * @param  mixed $string the object to compare with the current object
   * @return boolean true if the specified object is equal to the current 
   *         object; otherwise false
   */
  public function equals($string) {
    if (!is_string($string) && !($string instanceof String)) {
      return false;
    } else {
      return $this->string === self::parseStringValue($string);
    }
  }

  /**
   * Returns an array containing individual characters as separated values
   * 
   * @return string[]
   */
  public function getCharArray() {
    $nextchar = function($string, &$pointer) {
      if (!isset($string[$pointer])) {
        return false;
      }
      $char = ord($string[$pointer]);
      if ($char < 128) {
        return $string[$pointer++];
      } else {
        if ($char < 224) {
          $bytes = 2;
        } elseif ($char < 240) {
          $bytes = 3;
        } elseif ($char < 248) {
          $bytes = 4;
        } elseif ($char == 252) {
          $bytes = 5;
        } else {
          $bytes = 6;
        }
        $str = substr($string, $pointer, $bytes);
        $pointer += $bytes;
        return $str;
      }
    };
    $pointer = 0;
    $arr = [];
    while (($chr = $nextchar($this->string, $pointer)) !== false) {
      $arr[] = $chr;
    }
    return $arr;
  }

  /**
   * Returns the character as the given index or null if the index does not exists
   * 
   * @param  int $index the index of the char value
   * @return StringObject|null the character as the given index or null if the index does not exists
   */
  public function charAt($index) {
    $arr = $this->getCharArray();
    if (isset($arr[$index])) {
      return new StringObject($arr[$index], "UTF-8");
    } else {
      return null;
    }
  }

  /**
   * Returns an iterator to iterate through individual characters
   * 
   * @return \ArrayIterator
   */
  public function getIterator() {
    return new \ArrayIterator($this->getCharArray());
  }

  /**
   * 
   * @param  mixed $string
   * @param  string $encoding
   * @return string 
   */
  public static function parseStringValue($string, $encoding = "UTF-8") {
    if (!is_string($string)) {
      $string = strval($string);
    }
    if ($encoding !== "UTF-8") {
      $string = mb_convert_encoding($string, "UTF-8", $encoding);
    }
    return $string;
  }

  /**
   * 
   * @param  string $string 
   * @return boolean
   */
  public static function validUTF8($string) {
    return mb_detect_encoding($string, 'UTF-8', true) !== false;
  }

  /**
   * Returns an array of all supported encodings
   * 
   * @return string[] an array of all supported encodings
   */
  public static function getSupportedEncodings() {
    return mb_list_encodings();
  }

  public function toArray() {
    
  }

}
