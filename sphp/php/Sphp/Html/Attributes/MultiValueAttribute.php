<?php

/**
 * MultiValueAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Core\Types\Arrays;
use Sphp\Core\Types\Strings;
use ArrayIterator;

/**
 * An implementation of a multivalue HTML attribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MultiValueAttribute extends AbstractAttribute implements \Countable, \IteratorAggregate {

  /**
   * stored individual values
   *
   * @var boolean|string[]
   */
  private $values = false;

  /**
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
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->values = Arrays::copy($this->values);
    $this->locked = Arrays::copy($this->locked);
  }

  /**
   * Returns an array of unique values parsed from the input
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string paramater can contain multiple comma separated unique values
   * 2. An array paramater can contain only one unique atomic value per value
   * 3. Duplicate values are ignored
   *
   * @param  string|string[] $values the value(s) to parse
   * @return string[] separated atomic values in an array
   */
  public static function parse($values) {
    if (is_array($values)) {
      $parsed = array_unique($values);
    } else {
      $values = preg_replace("(\ {2,})", " ", trim($values));
      $parsed = [];
      if (!Strings::isEmpty($values)) {
        $parsed = array_unique(explode(" ", $values));
      }
    }
    return $parsed;
  }

  /**
   * Sets new atomic values to the attribute removing old non locked ones
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A `string` paramater can contain multiple comma separated atomic values
   * 2. An `array` paramater can contain only one atomic value per array value
   * 3. Any numeric value is treated as a string value
   * 4. Stores only a single instance of every value (no duplicates)
   *
   * @param  scalar|string[] $values the values to set
   * @return self for PHP Method Chaining
   */
  public function set($values) {
    $this->clear();
    if (is_array($values) || is_string($values) || is_numeric($values)) {
      $this->add($values);
    } else if (!$this->isLocked()) {
      $this->values = $this->isDemanded() || boolval($values);
    }
    return $this;
  }

  /**
   * Adds new atomic values to the attribute
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string paramater can contain multiple comma separated atomic values
   * 2. An array paramater can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  string|string[] $values the values to add
   * @return self for PHP Method Chaining
   */
  public function add($values) {
    $arr = self::parse($values);
    $numNew = count($arr);
    if ($numNew > 0) {
      if (!is_array($this->values)) {
        $this->values = [];
      }
      $this->values = array_unique(array_merge($arr, $this->values));
      sort($this->values);
    }
    return $this;
  }

  /**
   * Checks whether the given atomic values are locked
   *
   * **Important:** Parameter <var>$values</var> restrictions and rules
   * 
   * 1. A string paramater can contain multiple comma separated atomic values
   * 2. An array paramater can contain only one atomic value per array value
   *
   * @param  null|string|string[] $values optional atomic values to check
   * @return boolean true if the given values are locked and false otherwise
   */
  public function isLocked($values = null) {
    if (is_array($values) || is_string($values) || is_numeric($values)) {
      $locked = !array_diff(self::parse($values), $this->locked);
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
   * 1. A string paramater can contain multiple comma separated atomic values
   * 2. An array paramater can contain only one atomic value per array value
   * 3. Stores only a single instance of every value (no duplicates)
   *
   * @param  string|string[] $values the atomic values to lock
   * @return self for PHP Method Chaining
   */
  public function lock($values) {
    $arr = self::parse($values);
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
   * 1. A string paramater can contain multiple comma separated atomic values
   * 2. An array paramater can contain only one atomic value per array value
   * 
   * @param    scalar|string[] $values the atomic values to remove
   * @return   self for PHP Method Chaining
   * @throws   UnmodifiableAttributeException if any of the given values is unmodifiable
   */
  public function remove($values) {
    if ($this->isLocked($values)) {
      throw new UnmodifiableAttributeException($this->getName() . " attribute values given are unremovable");
    } else if (is_array($this->values)) {
      $arr = self::parse($values);
      if (count($arr) > 0) {
        $this->values = array_unique(array_merge($this->locked, array_diff($this->values, $arr)));
        sort($this->values);
      }
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function clear() {
    if ($this->isLocked()) {
      $this->values = Arrays::copy($this->locked);
    } else {
      $this->values = $this->isDemanded();
    }
    return $this;
  }

  /**
   * Determines whether the given atomic values exists
   *
   * **Important:** Parameter <var>$values</var> values (restrictions and rules)
   * 
   * 1. A string paramater can contain multiple comma separated atomic values
   * 2. An array paramater can contain only one atomic value per array value
   *
   * @param  string|string[] $values the atomic values to search for
   * @return boolean true if the given atomic values exists
   */
  public function contains($values) {
    if (is_array($this->values)) {
      $needle = self::parse($values);
      return !array_diff($needle, $this->values);
    } else {
      return false;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getValue() {
    if (is_array($this->values)) {
      $value = implode(" ", $this->values);
    } else {
      $value = $this->isDemanded() || boolval($this->values);
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
    if (is_array($this->values)) {
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
    if (is_array($this->values)) {
      $it = new ArrayIterator($this->values);
    } else {
      $it = new ArrayIterator();
    }
    return $it;
  }

}
