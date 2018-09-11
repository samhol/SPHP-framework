<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use ArrayAccess;
use Iterator;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Implements an property attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PropertyAttribute extends AbstractMutableAttribute implements ArrayAccess, Iterator, CollectionAttributeInterface {

  /**
   * properties as a (name -> value) map
   *
   * @var scalar[]
   */
  private $props = [];

  /**
   * names of all locked properties
   *
   * @var boolean[]
   */
  private $lockedProps = [];


  private $propSeparator = ';';
  private $nameValueSeparator = ':';

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   */
  public function __construct(string $name) {
    parent::__construct($name);
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
   * @param  string|array $properties properties to parse
   * @return scalar[] parsed property array containing name value pairs
   */
  public function parse($properties, bool $removeInvalid = false): array {
    $parsed = [];
    if (is_array($properties)) {
      $parsed = $properties;
      //$parsed = array_walk($properties, 'trim');
    } else if (is_string($properties)) {
      $parsed = $this->parseStringToArray($properties);
    }
    if ($removeInvalid) {
      $parsed = $this->removeInvalidProperties($parsed);
    }
    return $parsed;
  }

  public function setPropertySeparator(string $separator) {
    $this->settings[0] = $separator;
    return $this;
  }

  public function setNameValueSeparator(string $separator) {
    $this->settings[1] = $separator;
    return $this;
  }

  /**
   * Validates a given property name 
   * 
   * @param  mixed $name the name of the property
   * @return boolean true if the property name is valid
   */
  public function isValidPropertyName($name): bool {
    return is_string($name) && $name !== '' && \Sphp\Stdlib\Strings::match($name, '/[^\s]+/');
  }

  /**
   * Validates a given value
   * 
   * @param  mixed $value the value of the property
   * @return boolean true if the property value is valid
   */
  public function isValidValue($value): bool {
    return is_scalar($value) && $value !== '' && \Sphp\Stdlib\Strings::match($value, '/[^\s]+/');
  }

  /**
   * Validates a given property name => value pair 
   * 
   * @param  mixed $name the name of the property
   * @param  mixed $value the value of the property
   * @return boolean true if the property name => value pair is valid
   */
  public function isValidProperty($name, $value): bool {
    return $this->isValidValue($value) && $this->isValidPropertyName($name);
  }

  /**
   * 
   * @param  array $properties
   * @return scalar[]
   */
  public function removeInvalidProperties(array $properties): array {
    return array_filter($properties, function ($value, $prop) {
      return $this->isValidValue($value) && $this->isValidPropertyName($prop);
    }, \ARRAY_FILTER_USE_BOTH);
  }

  public function parseStringToArray(string $properties, bool $removeInvalid = false): array {
    $parsed = [];
    $rows = explode($this->propSeparator, $properties);
    if (empty($rows)) {
      $rows = [$properties];
    }
    foreach ($rows as $row) {
      $data = explode($this->nameValueSeparator, $row, 2);
      if (count($data) === 2) {
        $parsed[trim($data[0])] = trim($data[1]);
      }
    }
    if ($removeInvalid) {
      $parsed = $this->removeInvalidProperties($parsed);
    }
    return $parsed;
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      $value = $this->getValue();
      if (is_string($value)) {
        $output .= '="' . $value . '"';
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || !empty($this->props);
  }

  public function isEmpty(): bool {
    return empty($this->props);
  }

  /**
   * Sets the properties values
   *
   * **IMPORTANT!:** Does not alter locked properties
   *
   * @param  scalar $value the value of the attribute
   * @return $this for a fluent interface
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function set($value) {
    $this->clear();
    $this->setProperties($this->parse($value));
    return $this;
  }

  /**
   * Sets an property name value pair
   *
   * **Note:** Replaces old mutable property value with the new one
   *
   * @param  string $property the name of the property
   * @param  mixed $value the value of the property
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function setProperty(string $property, $value) {
    //echo "\n$property: $value;\n";
    if ($this->isProtected($property)) {
      throw new ImmutableAttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    if (!$this->isValidPropertyName($property)) {
      throw new InvalidAttributeException("Property name cannot be empty in the " . $this->getName() . " attribute");
    }
    if (!$this->isValidValue($value)) {
      throw new InvalidAttributeException("Property value cannot be empty in the " . $this->getName() . " attribute");
    }
    $this->props[$property] = $value;
    $this->lockedProps[$property] = false;
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
   * @param  string[] $props new property name value pairs
   * @return $this for PHP Method Chaining
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
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
   * @param  string $name the name of the property to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function unsetProperty(string $name) {
    if ($this->isProtected($name)) {
      throw new ImmutableAttributeException("'" . $this->getName() . "' property '$name' is immutable");
    } else {
      unset($this->props[$name], $this->lockedProps[$name]);
    }
    return $this;
  }

  /**
   * Removes given properties
   *
   * @param  string[] $names the names of the properties to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the properties are immutable
   */
  public function unsetProperties(array $names) {
    foreach ($names as $name) {
      $this->unsetProperty($name);
    }
    return $this;
  }

  public function clear() {
    foreach ($this->lockedProps as $property => $locked) {
      if (!$locked) {
        $this->unsetProperty($property);
      }
    }
    return $this;
  }

  /**
   * Determines whether the given property exists
   *
   * @param  string $property the name of the property
   * @return boolean true if the property exists and false otherwise
   */
  public function hasProperty(string $property): bool {
    return isset($this->props[$property]);
  }

  /**
   * Returns the value of the property name or null if the property does not exist
   *
   * @param  string $property the name of the property
   * @return scalar|null the value of the property or null if the property does not exists
   */
  public function getProperty(string $property) {
    if ($this->hasProperty($property)) {
      $value = $this->props[$property];
    } else {
      $value = null;
    }
    return $value;
  }

  /**
   * Checks whether the value or the given property is locked
   *
   * @param  string $property optional name of the property; if none given
   *         checks if any of the stored properties are locked
   * @return boolean true if locked and false otherwise
   */
  public function isProtected(string $property = null): bool {
    if ($property === null) {
      return in_array(true, $this->lockedProps);
    }
    return $this->hasProperty($property) && $this->lockedProps[$property] === true;
  }

  /**
   * Locks an property name value pair to the attribute
   *
   * **Note:** Replaces old not locked property values with the new ones
   *
   * @param  string $property the name of the property
   * @param  string $value the value of the property
   * @return $this for a fluent interface
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function lockProperty(string $property, $value) {
    if ($this->isProtected($property)) {
      throw new ImmutableAttributeException("'{$this->getName()}' property '$property' is immutable");
    }
    $this->setProperty($property, $value);
    $this->lockedProps[$property] = true;
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
   * @param  array $props properties as `name => value` pairs
   * @return $this for PHP Method Chaining
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
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
   * @param  null|string|string[] $props optional property/properties to lock
   * @return $this for PHP Method Chaining
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already immutable
   */
  public function protect($props = null) {
    if ($props === null) {
      $this->lockedProps = array_keys($this->props);
    } else {
      $this->lockProperties($this->parse($props));
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
      $props = [];
      foreach ($this->props as $k => $v) {
        $props [] = "$k{$this->nameValueSeparator}$v";
      }
      $output = implode($this->propSeparator, $props);
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
  public function count(): int {
    return count($this->props);
  }

  /**
   * Determines whether the given property exists
   *
   * @param  string $property the name of the property
   * @return boolean true if the property exists and false otherwise
   */
  public function offsetExists($property): bool {
    return $this->hasProperty($property);
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
   * @param  string $property the name of the property
   * @param  scalar $value the value of the property
   * @return void
   * @throws InvalidAttributeException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function offsetSet($property, $value) {
    $this->setProperty($property, $value);
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

  public function toArray(): array {
    return $this->props;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->props);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->props);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->props);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->props);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->props);
  }

}
