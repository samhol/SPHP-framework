<?php

/**
 * PropertyAttribute.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use ArrayAccess;
use Countable;
use IteratorAggregate;
use Sphp\Stdlib\Strings;
use InvalidArgumentException;

/**
 * Implements an property attribute object for an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PropertyAttribute extends AbstractAttribute implements ArrayAccess, Countable, IteratorAggregate {

  /**
   * properties as a (name -> value) map
   *
   * @var string[]
   */
  private $props = [];

  /**
   * names of all locked properties
   *
   * @var string[]
   */
  private $lockedProps = [];

  /**
   *
   * @var string
   */
  private $form;

  /**
   * 
   * @param string $name the name of the attribute
   * @param string $parser
   * @param string $form
   */
  public function __construct($name, $parser = null, $form = "%s:%s;") {
    parent::__construct($name);
    $this->form = $form;
  }

  public function __destruct() {
    unset($this->props, $this->lockedProps);
    parent::__destruct();
  }

  /**
   * Parses a string of properties to an array
   *
   * Result array has properties names as keys and corresponding values as
   *  array values
   *
   * @param  string $properties properties to parse
   * @return string[] parsed property array containing name value pairs
   */
  public static function parse($properties) {
    $parsed = [];
    if (is_array($properties)) {
      $parsed = $properties;
    } else if (is_string($properties)) {
      $rows = explode(';', $properties);
      if (empty($rows)) {
        $rows = [$properties];
      }
      foreach ($rows as $row) {
        $data = explode(':', $row, 2);
        if (count($data) === 2) {
          $parsed[trim($data[0])] = trim($data[1]);
        }
      }
    } 
    return array_filter($parsed, function ($var) {
      return !empty($var) || $var === "0";
    }, \ARRAY_FILTER_USE_BOTH);
  }

  /**
   * Sets the properties values
   *
   * **IMPORTANT!:** Does not alter locked properties
   *
   * @param  scalar $value the value of the attribute
   * @return self for a fluent interface
   * @throws AttributeException if the property is unmodifiable
   * @throws InvalidArgumentException if the value is invalid
   */
  public function set($value) {
    $this->clear();
    $this->setProperties(self::parse($value));
    return $this;
  }

  /**
   * Sets an property name value pair
   *
   * **Note:** Replaces old property value with the new one
   *
   * @param  string $property the name of the property
   * @param  string $value the value of the property
   * @return self for a fluent interface
   * @throws AttributeException if the property is unmodifiable
   * @throws InvalidArgumentException if either the property name or the value is invalid
   */
  public function setProperty($property, $value) {
    if ($this->isLocked($property)) {
      throw new AttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    if (Strings::isEmpty($property)) {
      throw new InvalidArgumentException("Property name cannot be empty in the " . $this->getName() . " attribute");
    }
    if (empty($value) && $value !== "0" && $value !== 0) {
      throw new InvalidArgumentException("Property value cannot be empty in the " . $this->getName() . " attribute");
    }
    $this->props[$property] = $value;
    return $this;
  }

  /**
   * Stores multiple property name value pairs
   *
   * **Notes:**
   *
   * * `$props` are defined as "property" => "value" pairs.
   * * Replaces old not locked property values with the new ones
   *
   * @param    string[] $props new property name value pairs
   * @return   self for PHP Method Chaining
   * @throws   AttributeException if any of the properties is already locked
   * @throws   InvalidArgumentException if any of the property names or values is invalid
   */
  public function setProperties(array $props) {
    foreach ($props as $property => $value) {
      $this->setProperty($property, $value);
    }
    return $this;
  }

  /**
   * Removes given property
   *
   * @param  string $name the names of the properties to remove
   * @return self for a fluent interface
   * @throws AttributeException if the property is unmodifiable
   */
  public function unsetProperty($name) {
    if ($this->isLocked($name)) {
      throw new AttributeException("'" . $this->getName() . "' property '$name' is unremovable");
    } else {
      unset($this->props[$name]);
    }
    return $this;
  }

  /**
   * Removes given properties
   *
   * @param  string[] $names the names of the properties to remove
   * @return self for a fluent interface
   * @throws AttributeException if any of the properties is unmodifiable
   */
  public function unsetProperties(array $names) {
    foreach ($names as $name) {
      $this->remove($name);
    }
    return $this;
  }

  public function clear() {
    $locked = array_flip($this->lockedProps);
    $this->props = array_intersect_key($this->props, $locked);
    return $this;
  }

  /**
   * Determines whether the given property exists
   *
   * @param  string $property the name of the property
   * @return boolean true if the property exists and false otherwise
   */
  public function hasProperty($property) {
    return array_key_exists($property, $this->props);
  }

  /**
   * Returns the value of the property name or null if the property does not exist
   *
   * @param  string|int $property the name of the property
   * @return scalar|null the value of the property or null if the property does not exists
   */
  public function getProperty($property) {
    if ($this->hasProperty($property)) {
      $value = $this->props[$property];
    } else {
      $value = null;
    }
    return $value;
  }

  /**
   * Checks whether the attribute or the given property is locked
   *
   * @param  string $property optional name of the property; if none given
   *         checks if any of the stored properties are locked
   * @return boolean true if locked and false otherwise
   */
  public function isLocked($property = null) {
    $locked = false;
    if ($property === null) {
      $locked = !empty($this->lockedProps);
    } else if (is_string($property)) {
      $locked = in_array($property, $this->lockedProps);
    } else if (is_array($property)) {
      $locked = !array_diff($property, $this->lockedProps);
    }
    return $locked;
  }

  /**
   * Locks an property name value pair to the attribute
   *
   * **Note:** Replaces old not locked property values with the new ones
   *
   * @param  string|int $property the name of the property
   * @param  string $value the value of the property
   * @return self for a fluent interface
   * @throws AttributeException if the property is already locked
   * @throws InvalidArgumentException if either the property name or the value is invalid
   */
  public function lockProperty($property, $value) {
    if ($this->isLocked($property)) {
      throw new AttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    $this->setProperty($property, $value);
    $this->lockedProps[] = $property;
    return $this;
  }

  /**
   * Stores multiple property value pairs
   *
   * **Notes:**
   *
   * * `$props` are defined as "property" => "value" pairs.
   * * Replaces old not locked property values with the new ones
   *
   * @param    string[] $props propertie as `name => value` pairs
   * @return   self for PHP Method Chaining
   * @throws   AttributeException if any of the properties is already locked
   * @throws   InvalidArgumentException if any of the property names or values is invalid
   */
  public function lockProperties(array $props) {
    foreach ($props as $property => $value) {
      $this->lockProperty($property, $value);
    }
    return $this;
  }

  /**
   * Locks either all or the given properties
   *
   * @param    null|string|string[] $props optional property/properties to lock
   * @return   self for PHP Method Chaining
   * @throws   AttributeException if any of the properties is already locked
   * @throws   InvalidArgumentException if if any of the properties has empty name or value
   */
  public function lock($props = null) {
    if ($props === null) {
      $this->lockedProps = array_keys($this->props);
    } else {
      $this->lockProperties(self::parse($props));
    }
    return $this;
  }

  /**
   * Returns the value of the property attribute as a string
   *
   * **IMPORTANT:**
   *
   * * Returns always `null` if attribute is not set.
   * * **However** might also return `null` for empty attributes.
   *
   * @return scalar the value of the property attribute
   */
  public function getValue() {
    if (!empty($this->props)) {
      $output = '';
      foreach ($this->props as $k => $v) {
        $output .= sprintf($this->form, $k, $v);
      }
    } else {
      $output = $this->isDemanded();
    }
    return $output;
  }

  /**
   * Counts the number of the style properties stored
   *
   * @return int the number of the style properties stored
   */
  public function count() {
    $num = 0;
    if (!empty($this->props)) {
      $num = count($this->props);
    }
    return $num;
  }

  /**
   * 
   * @param  string|int $property the name of the property
   * @return boolean
   */
  public function offsetExists($property) {
    return $this->hasProperty($property);
  }

  /**
   * 
   * @param  string|int $property the name of the property
   * @return scalar
   */
  public function offsetGet($property) {
    return $this->getProperty($property);
  }

  /**
   * 
   * @param  string|int $property the name of the property
   * @param  string|int $value
   * @throws AttributeException if any of the properties is already locked
   * @throws InvalidArgumentException if if any of the properties has empty name or value
   */
  public function offsetSet($property, $value) {
    $this->setProperty($property, $value);
  }

  /**
   * 
   * @param string|int $property the name of the property
   */
  public function offsetUnset($property) {
    $this->remove($property);
  }

  /**
   * Retrieves an external iterator to iterate through the atomic values on the attribute
   *
   * @return ArrayIterator to iterate through the atomic values on the attribute
   */
  public function getIterator() {
    if ($this->count() > 0) {
      $it = new ArrayIterator($this->props);
    } else {
      $it = new ArrayIterator();
    }
    return $it;
  }

  /**
   * 
   * @return scalar[]
   */
  public function toArray() {
    return $this->props;
  }

}
