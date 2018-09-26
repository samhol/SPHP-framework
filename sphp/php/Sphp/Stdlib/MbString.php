<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use Countable;
use ArrayAccess;
use Iterator;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Implements a multi byte string class
 * 
 * @method bool isAlpha()  Checks whether or not the input string contains only alphabetic chars
 * @method bool isAlphanumeric() Checks whether or not the input string contains only alphanumeric chars
 * @method bool caseIs(int $case) Checks the case folding
 * @method static convertCase(int $case) Perform a case folding returning a new instance
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MbString implements Countable, Iterator, Arrayable, ArrayAccess {

  private static $stringReflector;

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
   * Constructor 
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

  public function __call(string $name, array $arguments) {
    if (self::$stringReflector === null) {
      self::$stringReflector = new \ReflectionClass(Strings::class);
    }
    if (!self::$stringReflector->hasMethod($name)) {
      throw new BadMethodCallException();
    }
    array_unshift($arguments, $this->str);
    $arguments[] = $this->encoding;
    $result = self::$stringReflector->getMethod($name)->invokeArgs(null, $arguments);
    if (is_string($result)) {
      return new static($result);
    } else {
      return $result;
    }
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
   * * 
   * @param string $search
   * @param  string $replacement The string to replace with
   * @return MbString the resulting string after the replacements
   */
  public function replace(string $search, string $replacement): MbString {
    return $this->regexReplace(preg_quote($search), $replacement);
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
    $arr = [];
    $length = mb_strlen($this->str, $this->encoding);
    for ($i = 0; $i < $length; $i += 1) {
      $arr[] = mb_substr($this->str, $i, 1, $this->encoding);
    }
    return $arr;
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
  public function offsetSet($offset, $value) {
    throw new BadMethodCallException("Object is immutable, cannot modify chars directly");
  }

  /**
   * 
   * @param  mixed $offset
   * @return void
   * @throws BadMethodCallException always because object is immutable
   */
  public function offsetUnset($offset) {
    throw new BadMethodCallException("Object is immutable, cannot unset chars directly");
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

}
