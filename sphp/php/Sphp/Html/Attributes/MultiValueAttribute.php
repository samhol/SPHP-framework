<?php

/**
 * MultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use IteratorAggregate;
use ArrayIterator;

/**
 * An implementation of a multivalue HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MultiValueAttribute extends AbstractAttribute implements Countable, IteratorAggregate {

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
   * Returns an array of unique values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated unique values
   * 2. An array parameter can contain only one unique atomic value per value
   * 3. Duplicate values are ignored
   *
   * @param  scalar|scalar[] $raw the value(s) to parse
   * @return scalar[] separated atomic values in an array
   */
  public static function parse($raw) {
    if (is_array($raw)) {
      $f = function ($var) {
        return !empty($var) || $var === "0" || $var === 0;
      };
      $arr = array_map("trim", $raw);
      $p = array_filter($arr, $f);
      $parsed = array_unique($p);
    } else if (is_string($raw)) {
      $raw = preg_replace('/\s+/S', ' ', trim($raw));
      $parsed = [];
      if (strlen($raw) > 0) {
        $parsed = array_unique(explode(' ', $raw));
      }
    } else if (is_numeric($raw)) {
      $parsed = [$raw];
    } else {
      $parsed = [];
    }
    return $parsed;
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
   * @return self for a fluent interface
   */
  public function set($values) {
    $this->clear();
    $parsed = self::parse($values);
    if (!empty($parsed)) {
      $this->values = array_unique(array_merge($parsed, $this->values));
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
   * @param  string|scalar[] $values the values to add
   * @return self for a fluent interface
   */
  public function add($values) {
    $parsed = self::parse($values);
    if (!empty($parsed)) {
      $this->values = array_unique(array_merge($parsed, $this->values));
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
  public function isLocked($values = null) {
    if (is_array($values) || is_string($values) || is_numeric($values)) {
      $parsed = self::parse($values);
      $locked = !empty($parsed) && !array_diff(self::parse($values), $this->locked);
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
   * @return self for a fluent interface
   */
  public function lock($values) {
    $arr = self::parse($values);
    //print_r($arr);
    if (count($arr) > 0) {
      $this->locked = array_unique(array_merge($this->locked, $arr));
      sort($this->locked);
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
   * @return self for a fluent interface
   * @throws AttributeException if any of the given values is unmodifiable
   */
  public function remove($values) {
    if ($this->isLocked($values)) {
      throw new AttributeException($this->getName() . ' attribute values given are unremovable');
    } else if (is_array($this->values)) {
      $arr = self::parse($values);
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
  public function contains($values) {
    $needle = self::parse($values);
    if (!empty($needle)) {
      return !array_diff($needle, $this->values);
    }
    return false;
  }

  public function getValue() {
    if (!empty($this->values)) {
      $value = implode(" ", $this->values);
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
  public function count() {
    $num = 0;
    if (!empty($this->values)) {
      $num = count($this->values);
    }
    return $num;
  }

  /**
   * Retrieves an external iterator to iterate through the atomic values on the attribute
   *
   * @return ArrayIterator to iterate through the atomic values on the attribute
   */
  public function getIterator() {
    return new ArrayIterator($this->values);
  }

  /**
   * 
   * @return scalar[]
   */
  public function toArray() {
    return $this->values;
  }

}
