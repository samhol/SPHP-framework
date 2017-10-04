<?php

/**
 * MultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use Iterator;
use Sphp\Stdlib\Strings;
use ClassAttributeFilter;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MultiValueAttribute extends AbstractAttribute implements Countable, Iterator {

  /**
   * stored individual values
   *
   * @var scalar[]
   */
  private $values = [];

  /*
   * locked individual values
   *
   * @var string[]
   */
  private $locked = [];

  /**
   *
   * @var ClassAttributeFilter
   */
  private $filter;

  public function __construct(string $name) {
    parent::__construct($name);
    $this->filter = Filters\ClassAttributeFilter::instance();
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->values, $this->locked);
    parent::__destruct();
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
  public function set($values) {
    $this->clear();
    //$parsed = $this->filter->filter(func_get_args());
    $this->add(func_get_args());
    /* if (!empty($parsed)) {
      $this->values = array_unique(array_merge($parsed, $this->values));
      } */
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
   * @param  string|scalar[] $values the values to add
   * @return $this for a fluent interface
   */
  public function add(...$values) {
    $parsed = $this->filter->filter($values);
    /* if (!empty($parsed)) {
      $this->values = array_unique(array_merge($parsed, $this->values));
      } */
    foreach ($parsed as $class) {
      if (!array_key_exists($class, $this->values)) {
        $this->values[$class] = false;
      }
    }
    return $this;
  }

  /**
   * Checks whether the given atomic values are locked
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated atomic values
   * 2. An array parameter can contain only one atomic value per array value
   *
   * @param  null|scalar|scalar[] $values optional atomic values to check
   * @return boolean true if the given values are locked and false otherwise
   */
  public function isLocked($values = null): bool {
    if ($values === null) {
      return in_array(true, $this->values);
    } else {

      $parsed = $this->filter->filter(func_get_args());
      foreach ($parsed as $class) {
        if (array_key_exists($class, $this->values)) {
          
        }
      }
    }

    if (is_array($values) || is_string($values) || is_numeric($values)) {
      $locked = !empty($parsed) && !array_diff($parsed, $this->locked);
    } else {
      $locked = count($this->locked) > 0;
    }
    return $locked;
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
  public function lock($values) {
    $arr = $this->filter->filter($values);
    //print_r($arr);
    if (count($arr) > 0) {
      $this->locked = array_unique(array_merge($this->locked, $arr));
      //sort($this->locked);
      $this->add($arr);
    }
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
   * @throws AttributeException if any of the given values is immutable
   */
  public function remove($values) {
    if ($this->isLocked($values)) {
      throw new AttributeException($this->getName() . ' attribute values given are immutable');
    } else if (is_array($this->values)) {
      $arr = $this->filter->filter($values);
      if (count($arr) > 0) {
        $this->values = array_unique(array_merge($this->locked, array_diff($this->values, $arr)));
        sort($this->values);
      }
    }
    return $this;
  }

  public function clear() {
    if ($this->isLocked()) {
      $this->values = $this->locked;
    } else {
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
  public function contains($values): bool {
    $needle = $this->filter->filter($values);
    if (!empty($needle)) {
      return !array_diff($needle, $this->values);
    }
    return false;
  }

  public function getValue() {
    if (!empty($this->values)) {
      $value = implode(' ', $this->values);
    } else {
      $value = $this->isDemanded();
    }
    return $value;
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
    return $this->values;
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
