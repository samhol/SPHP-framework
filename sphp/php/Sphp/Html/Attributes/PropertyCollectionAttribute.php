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
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\NullPointerException;

/**
 * Implements an property attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PropertyCollectionAttribute extends AbstractAttribute implements ArrayAccess, Iterator, CollectionAttribute {

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

  /**
   * @var PropertyParser 
   */
  private $parser;

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param PropertyParser $parser
   */
  public function __construct(string $name, PropertyParser $parser = null) {
    parent::__construct($name);
    if ($parser === null) {
      $parser = new PropertyParser();
    }
    $this->parser = $parser;
  }

  public function __destruct() {
    unset($this->props, $this->lockedProps, $this->parser);
  }

  public function __toString(): string {
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
   * @throws InvalidArgumentException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function setValue($value) {
    $this->setProperties($this->parser->parse($value));
    return $this;
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
   * @throws InvalidArgumentException if any of the properties has empty name or value
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
   * @throws InvalidArgumentException if any of the properties has empty name or value
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
   * @throws InvalidArgumentException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already immutable
   */
  public function protectValue($props = null) {
    if ($props === null) {
      $this->lockedProps = array_keys($this->props);
    } else {
      $this->lockProperties($this->parser->parse($props));
    }
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
   * @throws InvalidArgumentException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function setProperty(string $property, $value) {
    //echo "\n$property: $value;\n";
    if ($this->isProtected($property)) {
      throw new ImmutableAttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    if (!$this->parser->isValidPropertyName($property)) {
      throw new InvalidArgumentException("Property name cannot be empty in the " . $this->getName() . " attribute");
    }
    if (!$this->parser->isValidValue($value)) {
      throw new InvalidArgumentException("Property value cannot be empty in the " . $this->getName() . " attribute");
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
   * @throws InvalidArgumentException if any of the properties has empty name or value
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
  public function unsetProperty($name) {
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
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->props = [];
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
   * Returns the value of the property name
   *
   * @param  string $property the name of the property
   * @return scalar the value of the property
   * @throws NullPointerException if the property does not exist
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
    if ($this->isEmpty()) {
      return null;
    }
    return $this->parser->propertiesToString($this->props);
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
   * @throws InvalidArgumentException if the property name or value is invalid
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
    $this->unsetProperty($property);
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
