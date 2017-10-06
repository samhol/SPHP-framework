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
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

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
   * @var boolean[]
   */
  private $lockedProps = [];

  /**
   *
   * @var string
   */
  private $form;

  /**
   * @var AttributeDataParser
   */
  private $parser;

  /**
   * Constructs a new instance
   * 
   * @param string $name the name of the attribute
   * @param string $parser
   * @param string $form
   */
  public function __construct(string $name, AttributeDataParser $parser = null, string $form = '%s:%s;') {
    parent::__construct($name);
    $this->form = $form;
    if ($parser === null) {
      $parser = Filters\StyleAttributeParser::instance();
    }
    $this->parser = $parser;
  }

  public function __destruct() {
    unset($this->props, $this->lockedProps, $this->parser);
    parent::__destruct();
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
    $this->setProperties($this->parser->parse($value));
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
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function setProperty(string $property, $value) {
    if ($this->isLocked($property)) {
      throw new ImmutableAttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    if (Strings::isEmpty($property)) {
      throw new AttributeException("Property name cannot be empty in the " . $this->getName() . " attribute");
    }
    if (empty($value) && $value !== "0" && $value !== 0) {
      throw new AttributeException("Property value cannot be empty in the " . $this->getName() . " attribute");
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
   * @return self for PHP Method Chaining
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
   * @param  string $name the names of the properties to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function unsetProperty($name) {
    if ($this->isLocked($name)) {
      throw new ImmutableAttributeException("'" . $this->getName() . "' property '$name' is unremovable");
    } else {
      unset($this->props[$name]);
    }
    return $this;
  }

  /**
   * Removes given properties
   *
   * @param  string[] $names the names of the properties to remove
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function unsetProperties(array $names) {
    foreach ($names as $name) {
      $this->remove($name);
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
  public function isLocked(string $property = null): bool {
    $locked = false;
    if ($property === null) {
      $locked = in_array(true, $this->lockedProps);
    } else if ($this->hasProperty($property)) {
      $locked = $this->lockedProps[$property];
    }
    return $locked;
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
    if ($this->isLocked($property)) {
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   * @throws AttributeException if any of the properties has empty name or value
   * @throws ImmutableAttributeException if any of the properties is already locked
   */
  public function lock($props = null) {
    if ($props === null) {
      $this->lockedProps = array_keys($this->props);
    } else {
      $this->lockProperties($this->parser->parse($props));
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
  public function count(): int {
    return count($this->props);
  }

  /**
   * 
   * @param  string|int $property the name of the property
   * @return boolean
   */
  public function offsetExists($property): bool {
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
   * @throws \Sphp\Exceptions\RuntimeException if any of the properties is already locked
   * @throws \Sphp\Exceptions\InvalidArgumentException if if any of the properties has empty name or value
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

  public function toArray(): array {
    return $this->props;
  }

}
