<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Iterator;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MultiValueAttribute extends AbstractAttribute implements Iterator, CollectionAttribute {

  /**
   * stored individual values
   *
   * @var array
   */
  private $values = [];

  /**
   * @var boolean
   */
  private $locked = false;

  /**
   * Constructor
   *
   * @param string $name the name of the attribute
   */
  public function __construct(string $name) {
    parent::__construct($name);
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->values, $this->locked);
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
    $result = preg_split('/[\s]+/', $subject, -1, \PREG_SPLIT_NO_EMPTY);
    if (!$result) {
      $result = [];
    }
    return $result;
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
  public function setValue($values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $this->clear();
    $this->add(func_get_args());
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
   * @param  scalar|scalar[],... $values the values to add
   * @return $this for a fluent interface
   */
  public function add(...$values) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException();
    }
    $parsed = $this->parse($values);
    $this->values = array_merge($this->values, $parsed);
    return $this;
  }

  /**
   * Checks whether the attribute value is locked
   *
   * @return boolean true if the given values are locked and false otherwise
   */
  public function isProtected(): bool {
    return $this->locked;
  }

  /**
   * Locks the specified atomic values
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|scalar[] $values the atomic values to lock
   * @return $this for a fluent interface
   */
  public function protectValue($values) {
    $this->locked = true;
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
    $this->values = array_diff($this->values, $arr);
    return $this;
  }

  public function clear() {
    if (!$this->isProtected()) {
      $this->values = [];
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
      $exists = in_array($needle, $this->values);
      if (!$exists) {
        break;
      }
    }
    return $exists;
  }

  public function getValue() {
    $output = null;
    if (!empty($this->values)) {
      $output = '';
      foreach ($this->values as $value) {
        $output .= ' ' . htmlspecialchars($value);
      }
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
    return count($this->values);
  }

  public function toArray(): array {
    return [$this->getName() => $this->values];
  }

  public function filter(callable $filter) {
    $this->values = array_unique(array_merge($this->locked, array_filter($this->values, $filter)));
    return $this;
  }

  public function filterPattern(string $pattern) {
    $filter = function($value) use ($pattern) {
      return Strings::match($value, $pattern);
    };
    $this->filter($filter);
    return $this;
  }

  public function getHtml(): string {
    $output = '';
    $value = $this->getValue();
    if ($value !== false) {
      $output .= $this->getName();
      if ($value !== true && !Strings::isEmpty($value)) {
        $strVal = $value;
        $output .= '="' . htmlspecialchars($strVal, ENT_COMPAT | ENT_HTML5) . '"';
      }
    }
    return $output;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->values);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->values);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->values);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->values);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->values);
  }

}
