<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Exceptions\AttributeException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Class contains and manages all the attribute value pairs for a markup language tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AbstractAttributeManager1 implements Countable, Iterator {

  /**
   * attributes as a (name -> value) map
   *
   * @var AttributeInterface[]
   */
  private $attrs = [];

  /**
   * attribute object type map as a (attribute name -> attribute object type) map
   *
   * @var string[]
   */
  private $map = [];

  /**
   * @var string 
   */
  private $defaultType;

  /**
   * Constructs a new instance
   *
   * @param array $objectMap
   * @param string $defaultType
   */
  public function __construct(array $objectMap = [], string $defaultType = AttributeInterface::class) {
    $this->defaultType = $defaultType;
    foreach ($objectMap as $name => $type) {
      $this->mapObject($name, $type);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrs, $this->map);
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
    $this->flags = Arrays::copy($this->map);
  }

  /**
   * Returns all attribute - value pairs as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString(): string {
    $output = '';
    foreach ($this as $attr) {
      $output .= " $attr";
    }
    return trim($output);
  }

  /**
   * Attaches an attribute object to the manager
   * 
   * **IMPORTANT:** 
   * 
   * 1. If manager has a set attribute already, such attribute cannot be replaced 
   *    by a new attribute object
   * 2. If attribute in the manager has already an attribute object instance the 
   *    new object must be of the same type
   * 
   * @param  string $name
   * @param  string $attrObject
   * @return $this for a fluent interface
   * @throws AttributeException
   */
  public function mapObject(string $name, string $attrObject) {
    if (!$this->isValidType($name, $attrObject)) {
      throw new AttributeException("Attribute name: '$name' must be of type : '{$this->getActualType($name)}'");
    }
    $this->map[$name] = $attrObject;
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  protected function getActualType(string $name): string {
    if ($this->getValidType($name) === AttributeInterface::class) {
      return Attribute::class;
    } else {
      return $this->getValidType($name);
    }
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  protected function getValidType(string $name): string {
    if ($this->isMapped($name)) {
      return $this->map[$name];
    } else {
      return $this->defaultType;
    }
  }

  /**
   * 
   * @param  string $name
   * @param  string|object $new
   * @return boolean
   */
  public function isValidType(string $name, $new): bool {
    if ($this->isMapped($name)) {
      return !is_subclass_of($new, $this->map[$name]);
    }
    return is_subclass_of($new, AttributeInterface::class);
  }

  /**
   * Checks whether the attribute name is mapped
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute name is mapped false otherwise
   */
  public function isMapped(string $name): bool {
    return array_key_exists($name, $this->map);
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   */
  protected function createObject(string $name): AttributeInterface {
    if ($this->exists($name)) {
      $obj = $this->attrs[$name];
    } else {
      $type = $this->getActualType($name);
      $obj = new $type($name);
      $this->attrs[$name] = $obj;
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
   * @throws AttributeException if the attribute name or value is invalid
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function set(string $name, $value = true) {
    $this->createObject($name)->set($value);
    return $this;
  }

  /**
   * Sets multiple attribute name value pairs
   *
   * For each `$attr => $value` pairs the method calls the {@link self::setAttr()} method
   *
   * @param  mixed[] $attrs an array of attribute name value pairs
   * @return $this for a fluent interface
   * @throws AttributeException if any of the attributes is invalid
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
    $this->createObject($name)->demand();
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
      return $this->createObject($name)->isDemanded();
    }
  }

  /**
   * Checks whether given attribute has a locked value on it
   *
   * **Note!:** some attributes can have multiple locked values (CSS classes,
   * inline styles etc.).
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute has a locked value on it and false otherwise
   */
  public function isLocked(string $name): bool {
    if (!$this->exists($name)) {
      return false;
    } else {
      return $this->createObject($name)->isLocked();
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
  public function lock(string $name, $value) {
    $this->createObject($name)->lock($value);
    return $this;
  }

  /**
   * Checks whether the attribute represents an empty attribute
   * 
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute is empty and false otherwise
   */
  public function isEmpty(string $name): bool {
    return $this->exists($name) && ($this->get($name) === true || $this->get($name) === "");
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute is immutable
   */
  public function remove(string $name) {
    if ($this->exists($name)) {
      $this->createObject($name)->clear();
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
   */
  public function get(string $name) {
    $value = false;
    if ($this->exists($name)) {
      $value = $this->createObject($name)->getValue();
    }
    return $value;
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   * @throws AttributeException
   */
  public function getObject(string $name): AttributeInterface {
    if (!$this->exists($name) && !$this->isMapped($name)) {
      throw new AttributeException("Attribute '$name' is not yet mapped or instantiated");
    }
    return $this->createObject($name);
  }

  /**
   * Checks if an attribute name exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute exists and false otherwise
   */
  public function exists(string $name): bool {
    return array_key_exists($name, $this->attrs);
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

}
