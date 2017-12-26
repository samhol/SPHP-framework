<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Abstract implementation of attribute manager for HTML components
 * 
 * Class contains and manages attribute value pairs for a markup language based 
 * object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeManager implements Countable, Iterator {

  /**
   * attributes as a (name -> value) map
   *
   * @var AttributeInterface[]
   */
  private $attrs = [];

  /**
   * @var AttributeGenerator 
   */
  private $gen;

  /**
   * Constructs a new instance
   * 
   * @param AttributeGenerator $gen
   */
  public function __construct(AttributeGenerator $gen = null) {
    if ($gen === null) {
      $gen = new AttributeGenerator();
    }
    $this->gen = $gen;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrs, $this->gen);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attrs = Arrays::copy($this->attrs);
    $this->gen = clone $this->gen;
  }

  /**
   * Returns attributes as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString(): string {
    return implode(' ', $this->attrs);
  }

  /**
   * Return the attribute generator instance used
   * 
   * @return AttributeGenerator the attribute generator instance used
   */
  public function getGenerator(): AttributeGenerator {
    return $this->gen;
  }

  /**
   * Returns named attribute object 
   * 
   * **IMPORTANT!** If the manager does not contain named instance, it creates and 
   * attaches a new object
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   */
  public function getObject(string $name): AttributeInterface {
    if (!$this->exists($name)) {
      $this->attrs[$name] = $this->gen->createObject($name);
    }
    return $this->attrs[$name];
  }

  /**
   * 
   * @param  AttributeInterface $attr
   * @return $this for a fluent interface
   * @throws InvalidAttributeException
   * @throws ImmutableAttributeException
   */
  public function setInstance(AttributeInterface $attr) {
    $name = $attr->getName();
    if (!$this->gen->isValidType($name, $attr)) {
      throw new InvalidAttributeException('Invalid attributetype (' . get_class($attr) . ') for ' . $name . ' attribute.' . $this->gen->getValidType($name) . " expected");
    }
    if (!$this->isProtected($name)) {
      if ($this->isDemanded($name)) {
        $attr->demand();
      }
      $this->attrs[$name] = $attr;
    } else {
      throw new ImmutableAttributeException("Attribute '$name' is immutable");
    }
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function supportsTypeChange(string $name, string $type): bool {
    if (!$this->isProtected($name)) {
      return $this->gen->isValidType($name, $type);
    }
    return false;
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function isIntegerAttribute(string $name): bool {
    if ($this->isInstatiated($name)) {
      return $this->attrs[$name] instanceof IntegerAttribute;
    }
    return $this->gen->isOfType($name, IntegerAttribute::class);
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function isBooleanAttribute(string $name): bool {
    if ($this->isInstatiated($name)) {
      return $this->attrs[$name] instanceof BooleanAttribute;
    }
    return $this->gen->isOfType($name, BooleanAttribute::class);
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function isIdentifier(string $name): bool {
    if ($this->isInstatiated($name)) {
      return $this->attrs[$name] instanceof IdAttribute;
    }
    return $this->gen->isOfType($name, IdAttribute::class);
  }

  /**
   * 
   * @param  AttributeInterface $attr
   * @return $this for a fluent interface
   * @throws InvalidAttributeException
   */
  public function setBoolean(string $name, bool $value = true) {
    if ($this->isBooleanAttribute($name)) {
      $this->attrs[$name]->set($value);
    } else {
      $attr = new BooleanAttribute($name, $value);
      $this->setInstance($attr);
    }
    return $this;
  }

  /**
   * 
   * @param  AttributeInterface $attr
   * @return $this for a fluent interface
   * @throws InvalidAttributeException
   */
  public function setInteger(string $name, int $value = null) {
    if ($this->isIntegerAttribute($name)) {
      $this->attrs[$name]->set($value);
    } else {
      $attr = new IntegerAttribute($name);
      $attr->set($value);
      $this->setInstance($attr);
    }
    return $this;
  }

  /**
   * 
   * @param  AttributeInterface $attr
   * @return $this for a fluent interface
   * @throws InvalidAttributeException
   */
  public function setIdentifier(string $name, string $value = null): IdAttribute {
    if ($this->isIdentifier($name)) {
      $this->attrs[$name]->set($value);
    } else {
      $attr = new IdAttribute($name, $value);
      $this->setInstance($attr);
    }
    return $this->attrs[$name];
  }

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   *  If the attribute value is locked the method throws a {@link UnmodifiableAttributeException}
   *
   * `$value` parameter:
   * 
   * Accepted attribute values are a subset of all PHP scalar types and different 
   * attributes are able to handle different values
   * 
   * 
   * Basic rules for values:
   * 
   * * empty `string` or boolean `true`: an empty attribute is set
   * * boolean `false` or `null`: attribute is removed or an attribute object it has no mutable value(s)
   * * otherwise the attribute value is a string conversion of the parameter value
   *
   * @param  string $name the name of the attribute
   * @param  scalar $value the value of the attribute
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the attribute name or value is invalid
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function set(string $name, $value = true) {
    $this->getObject($name)->set($value);
    return $this;
  }

  /**
   * Sets multiple attribute name value pairs
   *
   * For each `$attr => $value` pairs the method calls the {@link self::setAttr()} method
   *
   * @param  mixed[] $attrs an array of attribute name value pairs
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if any of the attributes is invalid
   * @throws ImmutableAttributeException if the value of the attribute is already locked
   */
  public function merge(array $attrs = []) {
    foreach ($attrs as $name => $value) {
      $this->set($name, $value);
    }
    return $this;
  }

  /**
   * Sets the given attribute name as required
   *
   * **IMPORTANT:** A required attribute cannot be removed but its value is still mutable
   *
   * @param  string $name the name of the required attribute
   * @return $this for a fluent interface
   */
  public function demand(string $name) {
    $obj = $this->getObject($name);
    if (!$obj instanceof Immutable) {
      $obj->demand();
    }
    $this->getObject($name)->demand();
    return $this;
  }

  /**
   * Checks whether an attribute is required or not
   *
   * **Note:** a required attribute either has locked value or the
   * attribute name is required.
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isDemanded(string $name): bool {
    if (!$this->exists($name)) {
      return false;
    } else {
      return $this->getObject($name)->isDemanded();
    }
  }

  /**
   * Checks whether given attribute has a locked value on it
   *
   * **Note!:** some attributes can have multiple locked values
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute has a locked value on it and false otherwise
   */
  public function isProtected(string $name): bool {
    if (!$this->exists($name)) {
      return false;
    } else {
      return $this->getObject($name)->isProtected();
    }
  }

  /**
   * Locks a given value to an attribute
   *
   * **IMPORTANT!:**
   *
   * 1. The `class` and the `style` attributes can have multiple locked values.
   * 2. Other attributes have the new value as locked value.
   * 3. Attribute values follow the rules defined in {@link self::set()}.
   *
   * @param  string $name the name of the attribute
   * @param  scalar $value the new locked value of the attribute
   * @return $this for a fluent interface
   * @throws AttributeException if either the name or the value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute is unmodifiable
   */
  public function protect(string $name, $value) {
    $this->getObject($name)->protect($value);
    return $this;
  }

  /**
   * Checks whether the manager has attribute instances
   * 
   * @return boolean true if the manager has attribute instances and false otherwise
   */
  public function containsAttributes(): bool {
    return !empty($this->attrs);
  }

  /**
   * Checks whether the attribute represents an empty attribute
   * 
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute is empty and false otherwise
   */
  public function isEmpty(string $name): bool {
    return $this->exists($name) && $this->getObject($name)->isEmpty();
  }

  /**
   * 
   * @param  string $name
   * @param  mixed $candidate
   * @return boolean true if the value of the attribute matches the given candidate
   */
  public function valueIs(string $name, $candidate): bool {
    if (!$this->isInstatiated($name)) {
      return false;
    } else {
      return $this->getObject($name)->getValue() == $candidate;
    }
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute value is protected
   */
  public function remove(string $name) {
    if ($this->exists($name)) {
      $this->getObject($name)->clear();
    }
    return $this;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns `boolean false` if attribute is not present.
   * * returns `true` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return scalar the value of the attribute
   * @deprecated
   */
  public function get(string $name) {
    return $this->getValue($name);
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns `boolean false` if attribute is not present.
   * * returns `true` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return scalar the value of the attribute
   */
  public function getValue(string $name) {
    $value = false;
    if ($this->exists($name)) {
      $value = $this->getObject($name)->getValue();
    }
    return $value;
  }

  /**
   * Checks if named attribute instance exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute instance exists and false otherwise
   */
  public function isInstatiated(string $name): bool {
    return isset($this->attrs[$name]);
  }

  /**
   * Checks if named attribute instance exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute instance exists and false otherwise
   */
  public function exists(string $name): bool {
    return isset($this->attrs[$name]);
  }

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count(): int {
    return count($this->attrs);
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->attrs);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->attrs);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->attrs);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->attrs);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->attrs);
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this as $name => $attr) {
      if ($attr->isVisible()) {
        $arr[$name] = $attr->getValue();
      }
    }
    return $arr;
  }

}
