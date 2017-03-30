<?php

/**
 * StringObject.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use ReflectionClass;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a chainable string class
 *
 * @method self append(string $str, string $stringAppend) Appends string to the end and returns a new instance
 * @method string charAt(int $index)
 * @method self between(string $start, string $end, int $offset = 0)
 * @method self camelize(string $str)
 * @method self collapseWhitespace(string $str)
 * @method bool contains(string $needle, bool $caseSensitive = true)
 * @method bool containsAll(string $needle, bool $caseSensitive = true)
 * @method bool containsAny(string $needle, bool $caseSensitive = true)
 * @method int countSubstr(string $substring, bool $caseSensitive = true)
 * @method self dasherize(string $str)
 * @method self delimit(string $str, string $delimiter)
 * @method bool endsWith(string $str, string $substring, bool $caseSensitive = true)
 * @method self ensureLeft(string $str, string $substring)
 * @method self ensureRight(string $str, string $substring)
 * @method self first(int $n)
 * @method bool hasLowerCase(string $str)
 * @method bool hasUpperCase(string $str)
 * @method self htmlDecode(int $flags = ENT_COMPAT)
 * @method self htmlEncode(int $flags = ENT_COMPAT)
 * @method self humanize(string $str)
 * @method int indexOf(string $str, string $needle, int $offset = 0)
 * @method int indexOfLast(string $str, string $needle, int $offset = 0)
 * @method self insert(string $str, string $substring, int $index = 0)
 * @method bool isAlpha()
 * @method bool isAlphanumeric()
 * @method bool isBase64(string $str)
 * @method bool isBlank(string $str)
 * @method bool isHexadecimal(string $str)
 * @method bool isJson()
 * @method bool isLowerCase()
 * @method bool isSerialized()
 * @method bool isUpperCase(string $str)
 * @method self last(string $str)
 * @method int length()
 * @method self[] lines(string $str)
 * @method self longestCommonPrefix(string $otherStr)
 * @method self longestCommonSuffix(string $otherStr)
 * @method self longestCommonSubstring(string $otherStr)
 * @method self lowerCaseFirst()
 * @method self pad(int $length, string $padStr = ' ', string $padType = 'right')
 * @method static padBoth(string $str, int $length, string $padStr = ' ')
 * @method static padLeft(string $str, int $length, string $padStr = ' ')
 * @method static padRight(string $str, int $length, string $padStr = ' ')
 * @method self prepend(string $string)
 * @method self regexReplace(string $pattern, string $replacement, string $options = 'msr')
 * @method self removeLeft(string $str, string $substring)
 * @method self removeRight(string $str, string $substring)
 * @method self repeat(string $str, int $multiplier)
 * @method self replace(string $str, string $search, string $replacement)
 * @method self reverse(string $str)
 * @method self safeTruncate(string $str, int $length, string $substring = '')
 * @method self shuffle(string $str)
 * @method self slugify(string $str, string $replacement = '-')
 * @method bool startsWith(string $str, string $substring, bool $caseSensitive = true)
 * @method self slice(string $str, int $start, int $end = null)
 * @method self split(string $str, string $pattern, int $limit = null)
 * @method self substr(string $str, int $start, int $length = null)
 * @method self surround(string $str, string $pre, string $post)
 * @method self swapCase(string $str)
 * @method self tidy(string $str)
 * @method self titleize(string $str)
 * @method self toAscii(string $str, bool $removeUnsupported = true)
 * @method bool toBoolean(string $str)
 * @method self toLowerCase()
 * @method self toSpaces(int $tabLength = 4)
 * @method self toTabs(int $tabLength = 4)
 * @method self toTitleCase()
 * @method self toUpperCase()
 * @method self trim(string $str, string $chars = null)
 * @method self trimLeft(string $str, string $chars = null)
 * @method self trimRight(string $str, string $chars = null)
 * @method self truncate(string $str, int $length, string $substring = '')
 * @method self underscored(string $str)
 * @method self upperCamelize(string $str)
 * @method self upperCaseFirst(string $str)
 */
class StringObject implements Countable, IteratorAggregate, ArrayAccess {

  /**
   *
   * @var ReflectionClass 
   */
  private static $stringsReflector;

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
   * Constructs a new instance 
   * 
   * $str is cast to a string prior to assignment, and if
   * $encoding is not specified, it defaults to mb_internal_encoding(). Throws
   * an InvalidArgumentException if the first argument is an array or object
   * without a __toString method.
   *
   * @param  mixed  $str Value to modify, after being cast to string
   * @param  string $encoding The character encoding
   * @throws \Sphp\Exceptions\InvalidArgumentException if an array or object without a
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
    if (static::$stringsReflector === null) {
      static::$stringsReflector = new ReflectionClass(Strings::class);
    }
  }

  /**
   * Returns the string value of the object
   *
   * @return string the string value of the object
   */
  public function __toString() {
    return $this->str;
  }

  /**
   * Creates a {@link self} object from given str and encoding properties
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
  public static function create($str = '', $encoding = null) {
    return new static($str, $encoding);
  }

  /**
   * 
   * @param  string $methodName
   * @param  array $args
   * @return array
   * @throws \Sphp\Exceptions\BadMethodCallException
   */
  private function parseParams($methodName, array $args) {
    $method = static::$stringsReflector->getMethod($methodName);
    $numArgs = array_unshift($args, $this->str);
    $required = $method->getNumberOfRequiredParameters();
    if ($numArgs < $required) {
      throw new BadMethodCallException($required . ' arguments required for method ' . $method->getName());
    }
    $rest = array_slice($method->getParameters(), $numArgs, null, true);
    foreach ($rest as $num => $param) {
      if ($param->getName() == "encoding" && $param->getDefaultValue() === null) {
        $args[$num] = $this->getEncoding();
      } else {
        $args[$num] = $param->getDefaultValue();
      }
    }
    return $args;
  }

  /**
   * Invokes the given method of {@link self} with the rest of the passed arguments.
   * 
   * The result is not cast, so the return value may be of type Stringy,
   * integer, boolean, etc.
   *
   * @param  string $name the name of the called method
   * @param  mixed $arguments
   * @return mixed
   * @throws \Sphp\Exceptions\BadMethodCallException
   */
  public function __call($name, $arguments) {
    $stringsClass = static::$stringsReflector;
    // if (isset(static::$methodArgs[$name])) {
    // $result = static::$methodArgs[$name];
    //$result["args"] = $this->parseParams($stringsClass->getMethod($name), $args);
    if (!$stringsClass->hasMethod($name)) {
      throw new BadMethodCallException($name . ' is not a valid method');
    }
    $call = $stringsClass->getName() . "::" . $name;
    $result = \call_user_func_array($call, $this->parseParams($name, $arguments));
    if (is_string($result) && $name != "charAt") {
      return static::create($result, $this->getEncoding());
    } else {
      return $result;
    }
  }

  /**
   * Returns the length of the string
   *
   * @return int the length of the string
   */
  public function count() {
    return $this->length();
  }

  /**
   * Returns whether or not a character exists at an index. 
   * 
   * Offsets may be negative to count from the last character in the string
   *
   * @param  mixed   $offset The index to check
   * @return boolean whether or not the index exists
   */
  public function offsetExists($offset) {
    $length = $this->length();
    $index = (int) $offset;
    if ($index >= 0) {
      return ($length > $index);
    }
    return ($length >= abs($index));
  }

  /**
   * Returns the character at the given index
   * 
   * Offsets may be negative to count from the last character in the string.
   *
   * @param  mixed $offset The index from which to retrieve the char
   * @return mixed the character at the specified index
   * @throws \Sphp\Exceptions\OutOfBoundsException if the positive or negative offset does
   *                               not exist
   */
  public function offsetGet($offset) {
    $index = (int) $offset;
    $length = $this->length();
    if (($index >= 0 && $length <= $index) || $length < abs($index)) {
      throw new OutOfBoundsException("No character exists at the index: ($index)");
    }
    return \mb_substr($this->str, $index, 1, $this->encoding);
  }

  /**
   * Implements part of the ArrayAccess interface

   * **IMPORTANT:** throws an exception when called. This maintains the 
   * immutability of the objects.
   *
   * @param  mixed $offset the index of the character
   * @param  mixed $value  value to set
   * @throws \Sphp\Exceptions\BadMethodCallException when called
   */
  public function offsetSet($offset, $value) {
    throw new BadMethodCallException("Object is immutable, cannot modify char at position $offset directly");
  }

  /**
   * Implements part of the ArrayAccess interface
   * 
   * **IMPORTANT:** throws an exception when called. This maintains the 
   * immutability of the objects.
   *
   * @param  mixed $offset The index of the character
   * @throws \Sphp\Exceptions\BadMethodCallException When called
   */
  public function offsetUnset($offset) {
    throw new BadMethodCallException('Object object is immutable, cannot unset char');
  }

  /**
   * Returns an array consisting of the characters in the string.
   *
   * @return self[] An array of string objects
   */
  public function chars() {
    $chars = Strings::chars($this->str, $this->encoding);
    $charObj = [];
    foreach ($chars as $index => $char) {
      $charObj[$index] = static::create($char, $this->encoding);
    }
    return $charObj;
  }

  /**
   * Returns a new ArrayIterator 
   * 
   * The ArrayIterator's constructor is passed an array of chars
   * in the multibyte string. This enables the use of foreach with instances
   * of StringObject\StringObject.
   *
   * @return ArrayIterator An iterator for the characters in the string
   */
  public function getIterator() {
    return new ArrayIterator($this->chars());
  }

  /**
   * Returns the current encoding used
   *
   * @return string the current encoding used
   */
  public function getEncoding() {
    return $this->encoding;
  }

}
