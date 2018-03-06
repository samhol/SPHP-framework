<?php

/**
 * Sequence.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Datastructures;

use Iterator;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\OutOfRangeException;

/**
 * An implementation of a sequence of values
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-03-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Sequence implements Iterator, \ArrayAccess {

  /**
   * stored individual values
   *
   * @var array
   */
  private $sequence = [];

  /**
   * @var int|null 
   */
  private $minLength = 0;

  /**
   * @var int|null 
   */
  private $maxLength = null;

  /**
   * Constructs a new instance
   *
   * @param array $options  the separator between individual values in sequence
   */
  public function __construct(array $options = []) {
    foreach ($options as $key => $value) {
      switch (strtolower($key)) {
        case 'separator':
          $this->setSequenceSeparator((string) $value);
          break;
        case 'minlength':
          $this->setMinLength((int) $value);
          break;
        case 'maxlength':
          $this->setMaxLength((int) $value);
          break;
        case 'default':
          $this->setDefault($value);
          break;
        case 'pattern':
          $this->setPattern($value);
          break;
      }
    }
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->sequence);
  }

  /**
   * Returns an array of unique values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain a single atomic value
   * 2. An array can be be multidimensional
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @param  bool $validate
   * @return string[] separated atomic values in an array
   * @throws InvalidAttributeException if validation is set and the input is not valid
   */
  public function parse($raw, bool $validate = false): array {
    $parsed = [];
    if (is_array($raw)) {
      $flat = Arrays::flatten($raw);
      foreach ($flat as $item) {
        $parsed = array_merge($parsed, $this->parseStringToArray($item));
      }
      //$vals = array_filter($parsed, 'is_string');
    } else if (is_string($raw)) {
      $parsed = $this->parseStringToArray($raw);
    }
    if ($validate) {
      foreach ($parsed as $value) {
        if (!$this->isValidAtomicValue($value)) {
          throw new InvalidAttributeException("Invalid attribute value '$value'");
        }
      }
    }
    return $parsed;
  }

  /**
   * Validates given atomic value
   * 
   * @param  mixed $value an atomic value to validate
   * @return bool true if the value is valid atomic value
   */
  public function isValidAtomicValue($value): bool {
    return is_scalar($value);
  }

  public function parseStringToArray(string $subject): array {
    $trimmed = trim($subject);
    $result = preg_split('/[' . $this->separator . ']+/', $trimmed, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return $result;
  }

  /**
   * Sets the separator between individual values in sequence
   * 
   * @param  string $separator the separator between individual values in sequence
   * @return $this for a fluent interface
   */
  protected function setSequenceSeparator(string $separator) {
    if ($separator === '') {
      throw new InvalidAttributeException();
    }
    $this->separator = $separator;
    return $this;
  }

  /**
   * 
   * @param  int $minLength
   * @return $this for a fluent interface
   */
  protected function setMinLength(int $minLength = 0) {
    $this->minLength = $minLength;
    return $this;
  }

  /**
   * 
   * @param int $maxLength
   * @return $this for a fluent interface
   */
  protected function setMaxLength(int $maxLength = null) {
    $this->maxLength = $maxLength;
    return $this;
  }

  /**
   * 
   * @param  string|float $default
   * @return $this for a fluent interface
   */
  protected function setDefault($default) {
    $this->default = $default;
    return $this;
  }

  /**
   * 
   * @param  int $position
   * @return boolean
   */
  protected function isValidPosition(int $position): bool {
    $test = $position + 1;
    return $this->minLength <= $test && ($this->maxLength === null || $this->maxLength >= $test);
  }

  /**
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A `string` parameter can contain multiple comma separated atomic values
   * 2. An `array` parameter can contain only one atomic value per array value
   * 3. Any numeric value is treated as a string value
   * 4. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[] $values the values to set
   * @return $this for a fluent interface
   */
  public function insert(int $index, $values) {
    $this->sequence[$index] = $values;
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  mixed,... $values the values to push
   * @return $this for a fluent interface
   */
  public function push(...$values) {
    $this->sequence = array_merge($this->sequence, $values);
    return $this;
  }

  /**
   * Removes given atomic values
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 
   * @param  scalar|scalar[] $values the atomic values to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the given values is immutable
   */
  public function remove(...$values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $arr = $this->parse($values);
    $this->sequence = array_diff($this->sequence, $arr);
    return $this;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->sequence = [];
    }
    return $this;
  }

  /**
   * Determines whether the given atomic values exists
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   *
   * @param  scalar|scalar[] $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function contains(...$values): bool {
    $needles = $this->parse($values);
    $exists = false;
    foreach ($needles as $needle) {
      $exists = in_array($needle, $this->sequence);
      if (!$exists) {
        break;
      }
    }
    return $exists;
  }

  public function getValue() {
    if (!empty($this->sequence)) {
      $raw = implode($this->separator, $this->sequence);
      $output = htmlspecialchars($raw);
    } else {
      $output = $this->isDemanded();
    }
    return $output;
  }

  /**
   * Counts the number of the atomic values stored in the attribute
   *
   * @return int the number of the atomic values stored in the attribute
   */
  public function count(): int {
    return count($this->sequence);
  }

  public function toArray(): array {
    return $this->sequence;
  }

  public function join(string $glue = ','): string {
    return implode($glue, $this->sequence);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->sequence);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->sequence);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->sequence);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->sequence);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->sequence);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  string $property the name of the property
   * @return boolean true if the property exists and false otherwise
   */
  public function offsetExists($property): bool {
    return $this->s($property);
  }

  /**
   * Returns the value of the property name or null if the property does not exist
   *
   * @param  string $property the name of the property
   * @return scalar|null the value of the property or null if the property does not exists
   */
  public function offsetGet($property) {
    return $this->getProperty($property);
  }

  /**
   * Sets an property name value pair
   *
   * **Note:** Replaces old mutable property value with the new one
   *
   * @param  string $position the name of the property
   * @param  scalar $value the value of the property
   * @return void
   * @throws InvalidAttributeException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function offsetSet($position, $value) {
    if (!$this->isValidPosition($position)) {
      throw new OutOfRangeException();
    }
    $this->sequence[$position] = $value;
  }

  /**
   * Removes given property
   *
   * @param  string $property the name of the property to remove
   * @return void
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function offsetUnset($property) {
    $this->remove($property);
  }

}
