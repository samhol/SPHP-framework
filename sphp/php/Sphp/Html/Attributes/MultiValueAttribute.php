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
use Sphp\Exceptions\InvalidArgumentException;
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
   * @var MultiValueParser
   */
  private $valueParser;

  /**
   * Constructor
   *
   * @param string $name
   * @param MultiValueParser|null $properties
   */
  public function __construct(string $name, MultiValueParser $properties = null) {
    parent::__construct($name);
    $this->setValueParser($properties);
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->values, $this->valueParser);
  }

  protected function setValueParser($properties) {
    if ($properties === null) {
      $properties = new MultiValueParser();
    }
    $this->valueParser = $properties;
    return $this;
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
   * @param  mixed ...$values the values to set
   * @return $this for a fluent interface
   */
  public function setValue($values) {
    $this->clear();
    if ($values !== null && $values !== false) {
      $this->add(func_get_args());
    }
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
    $parsed = $this->valueParser->filter($values);
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
    $arr = $this->valueParser->filter($values);
    $this->values = array_diff($this->values, $arr);
    return $this;
  }

  public function clear() {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->values = [];
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
    $needles = $this->valueParser->filter($values);
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
      $output = $this->valueParser->parseArrayToString($this->values);
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
