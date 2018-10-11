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
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Implements a multi byte string class
 * 
 * @method bool isBinary() Checks whether or not the input string contains only binary chars
 * @method bool isHexadecimal() Checks whether or not the input string contains only hexadecimal chars
 * @method bool isAlpha() Checks whether or not the input string contains only alphabetic chars
 * @method bool isAlphanumeric() Checks whether or not the input string contains only alphanumeric chars
 * @method bool caseIs(int $case) Checks the case folding
 * 
 * @method \Sphp\Stdlib\MbString convertCase(int $case) Perform a case folding returning a new instance
 * @method \Sphp\Stdlib\MbString trim(string $charMask = null) Returns a new instance with whitespace removed from the start end the end
 * @method \Sphp\Stdlib\MbString trimLeft(string $charMask = null) Returns a new instance with whitespace removed from the start
 * @method \Sphp\Stdlib\MbString trimRight(string $charMask = null) Returns a new instance with whitespace removed from the end
 * 
 * @method int countSubstr(string $substring) Returns the number of occurrences of $substring in the given string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
    $stringReflector = new \ReflectionClass(Strings::class);

    if (!$stringReflector->hasMethod($name)) {
      throw new BadMethodCallException("Method '$name' does not exist");
    }
    array_unshift($arguments, $this->str);
    $method = $stringReflector->getMethod($name);
    if ($method->getNumberOfParameters() > count($arguments)) {
      foreach ($method->getParameters() as $num => $param) {
        if (!isset($arguments[$num]) && $param->isDefaultValueAvailable()) {
          $arguments[$num] = $param->getDefaultValue();
          // echo '$arguments[' . $num . '] = ' . var_export($param->getDefaultValue(), true);
        }
      }
    }
    //$arguments[] = $this->encoding;
    $result = $stringReflector->getMethod($name)->invokeArgs(null, $arguments);
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
   * Returns the character at $index, with indexes starting at 0
   *
   * @param  int $index position of the character
   * @param  string|null $encoding the character encoding parameter;
   *                Defaults to `mb_internal_encoding()`
   * @return string the character at $index or null if the index does not exist
   * @throws OutOfBoundsException if the index does not exist
   */
  public function charAt(int $index, string $encoding = null): string {
    return Strings::charAt($this->str, $index, $encoding);
  }

  /**
   * Returns an array consisting of the characters in the string
   *
   * @return string[] An array of individual chars
   */
  public function toArray(): array {
    return Strings::toArray($this->str, $this->encoding);
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
   * @return string character at the given index 
   * @throws OutOfBoundsException if the offset does not exist
   * @throws InvalidArgumentException
   */
  public function offsetGet($offset) {
    if (!$this->offsetExists($offset)) {
      throw new OutOfBoundsException('Offset must be between 0 and ' . ($this->count() - 1));
    }
    return $this->charAt($offset);
  }

  /**
   * Sets the character at given $offset 
   * 
   * @param  mixed $offset
   * @param  mixed $value
   * @return void
   * @throws InvalidArgumentException
   * @throws OutOfBoundsException
   */
  public function offsetSet($offset, $value) {
    if ($offset === null) {
      $offset = $this->count();
    }
    if (!$this->offsetExists($offset) && $offset !== $this->count()) {
      throw new OutOfBoundsException('Offset must be between 0 and ' . $this->count() . ' or null');
    }
    if (mb_strlen($value) > 1) {
      throw new InvalidArgumentException('Value must be exactly one char');
    }
    $this->str = substr_replace($this->str, $value, $offset, 1);
  }

  /**
   * Unsets the character at the given index
   * 
   * @param  mixed $offset
   * @return void
   * @throws InvalidArgumentException
   * @throws OutOfBoundsException
   */
  public function offsetUnset($offset) {
    if (!$this->offsetExists($offset)) {
      throw new OutOfBoundsException('Offset must be between 0 and ' . ($this->count() - 1) . '');
    }
    $this->str = substr_replace($this->str, '', $offset, 1);
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
