<?php

/**
 * JsonAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use ArrayAccess;
use Iterator;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Stdlib\Parser;
use Sphp\Stdlib\Readers\Json;

/**
 * Implements an JSON attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class JsonAttribute extends AbstractAttribute implements ArrayAccess, Iterator, CollectionAttributeInterface {

  /**
   * properties as a (name -> value) map
   *
   * @var scalar[]
   */
  private $data = [];

  /**
   * names of all locked properties
   *
   * @var boolean[]
   */
  private $lockedProps = [];

  /**
   * @var string
   */
  private $form;

  /**
   * @var Json
   */
  private $parser;

  /**
   * Constructs a new instance
   * 
   * @param string $name the name of the attribute
   * @param scalar|null $value optional value of the attribute
   */
  public function __construct(string $name, $value = null) {
    $this->parser = Parser::json();
    parent::__construct($name);
    if (is_string($value) || is_array($value)) {
      $this->set($value);
    }
  }

  public function __destruct() {
    unset($this->data, $this->lockedProps, $this->parser);
    parent::__destruct();
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      $value = $this->getValue();
      if (is_string($value)) {
        $output .= "='$value'";
      }
    }
    return $output;
  }

  public function isVisible(): bool {
    return $this->isDemanded() || !empty($this->data);
  }

  public function isEmpty(): bool {
    return empty($this->data);
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
    try {
      $this->clear();
      if (is_scalar($value)) {
        $this->data = $this->parser->fromString($value);
      } else if (is_array($value)) {
        $this->data = $value;
      }
      //$this->setProperty($this->parser->parse($value));
    } catch (\Exception $ex) {
      throw new InvalidAttributeException();
    }
    return $this;
  }

  /**
   * Sets an property name value pair
   *
   * **Note:** Replaces old mutable property value with the new one
   *
   * @param  string $property the name of the property
   * @param  scalar|array $value the value of the property
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the property name or value is invalid
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function setProperty(string $property, $value) {
    if ($this->isProtected($property)) {
      throw new ImmutableAttributeException("'{$this->getName()}' property '$property' is unmodifiable");
    }
    $this->data[$property] = $value;
    $this->lockedProps[$property] = false;
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
      unset($this->data[$name], $this->lockedProps[$name]);
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
    return isset($this->data[$property]);
  }

  /**
   * Returns the value of the property name or null if the property does not exist
   *
   * @param  string $property the name of the property
   * @return scalar|null the value of the property or null if the property does not exists
   */
  public function getProperty(string $property) {
    if ($this->hasProperty($property)) {
      $value = $this->data[$property];
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
      $this->lockedProps = array_keys($this->data);
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
    if (!empty($this->data)) {
      $output = '';
      foreach ($this->data as $k => $v) {
        $output .= sprintf($this->form, $k, $v);
      }
    } else {
      $output = $this->isDemanded();
    }
    $p = new Json();
    return $p->encode($this->data);
  }

  /**
   * Counts the number of the style properties stored
   *
   * @return int the number of the style properties stored
   */
  public function count(): int {
    return count($this->data);
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
    return $this->data;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->data);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->data);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->data);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->data);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->data);
  }

}
