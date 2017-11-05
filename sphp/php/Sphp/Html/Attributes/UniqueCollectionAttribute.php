<?php

/**
 * AtomicMultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Iterator;
use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Utils\UniqueCollectionAttributeUtils;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Utils\Factory;

/**
 * An implementation of a multi value HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UniqueCollectionAttribute extends AbstractAttribute implements Iterator, CollectionAttributeInterface {

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
   * @var UniqueCollectionAttributeUtils
   */
  private $filter;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param UniqueCollectionAttributeUtils $u
   */
  public function __construct(string $name, UniqueCollectionAttributeUtils $u = null) {
    if ($u === null) {
      $u = Factory::instance()->getUtil(UniqueCollectionAttributeUtils::class);
    }
    $this->filter = $u;
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
   * @return MultiValueAttributeUtils
   */
  public function getValueFilter(): MultiValueAttributeUtils {
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
    $parsed = $this->getValueFilter()->parse($values, true);
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
  public function isProtected($values = null): bool {
    if ($values === null) {
      return !empty($this->locked);
    } else {
      $parsed = $this->getValueFilter()->parse($values, true);
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
  public function protect($values) {
    $parsed = $this->filter->parse(func_get_args());
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
    $arr = $this->getValueFilter()->parse(func_get_args());
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
    $needles = $this->filter->parse($values);
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
    $output = null;
    if (!empty($this->values)) {
      $output = '';
      foreach ($this->values as $value) {
        $output .= htmlspecialchars($value);
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

  public function getHtml(): string {
    $output = '';
    $value = $this->getValue();
    if ($value !== false) {
      $output .= $this->getName();
      if ($value !== true && !Strings::isEmpty($value)) {
        $strVal = Strings::toString($value);
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






