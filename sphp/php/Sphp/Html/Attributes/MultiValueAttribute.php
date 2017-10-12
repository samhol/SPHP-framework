<?php

/**
 * MultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use IteratorAggregate;
use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Utils\MultiValueAttributeFilter;
use Sphp\Stdlib\Datastructures\Collection;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MultiValueAttribute extends AbstractAttribute implements Countable, IteratorAggregate {

  /**
   * stored individual values
   *
   * @var array
   */
  private $values = [];

  /*
   * locked individual values
   *
   * @var array
   */
  private $locked = [];

  /**
   * @var MultiValueAttributeFilter
   */
  private $filter;

  public function __construct(string $name) {
    $this->filter = MultiValueAttributeFilter::instance();
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
    parent::__destruct();
  }

  /**
   * 
   * @return MultiValueAttributeFilter
   */
  public function getValueFilter(): MultiValueAttributeFilter {
    return $this->filter;
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
   * @param  scalar|scalar[] $values the values to add
   * @return $this for a fluent interface
   */
  public function add(...$values) {
    $parsed = $this->getValueFilter()->filter($values, true);
    $this->values = array_unique(array_merge($this->values, $parsed));
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
      return !empty($this->locked);
    } else {
      $parsed = $this->getValueFilter()->filter($values, true);
      return empty(array_diff($parsed, $this->locked));
    }
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
    $parsed = $this->filter->filter(func_get_args());
    $this->values = array_unique(array_merge($this->values, $parsed));
    $this->locked = array_unique(array_merge($this->locked, $parsed));
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
  public function remove($values) {
    $arr = $this->getValueFilter()->filter(func_get_args());
    $this->values = array_diff(array_diff($arr, $this->locked), $this->values);
    return $this;
  }

  public function clear() {
    $this->values = $this->locked;
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
    $needles = $this->filter->filter($values);
    $exists = false;
    foreach ($needles as $needle) {
      $exists = in_array($needle, $this->value);
      if (!$exists) {
        break;
      }
    }
    return $exists;
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

  public function getIterator() {
    return new Collection($this->toArray());
  }

}
