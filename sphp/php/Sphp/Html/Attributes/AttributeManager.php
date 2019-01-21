<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\IllegalStateException;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Abstract implementation of attribute manager for HTML components
 * 
 * Class contains and manages attribute value pairs for a markup language based 
 * object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AttributeManager implements Countable, Arrayable {

  /**
   * attributes as a (name -> value) map
   *
   * @var Attribute[]
   */
  private $attrs = [];

  /**
   * @var AttributeGenerator 
   */
  private $gen;

  /**
   * Constructor
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
   * Destructor
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

  public function __call($name, $arguments) {
    $obj = $this->getObject($name)->setValue($arguments[0]);
    return $obj;
  }

  public function __get($name) {
    return $this->getObject($name);
  }

  public function __set($name, $value) {
    $this->getObject($name)->setValue($value);
  }

  /**
   * Return the attribute generator instance used
   * 
   * @return AttributeGenerator the attribute generator instance used
   */
  public function getObjectMap(): AttributeGenerator {
    return $this->gen;
  }

  /**
   * Returns named attribute object 
   * 
   * **IMPORTANT!** If the manager does not contain named instance, it creates and 
   * attaches a new object
   *
   * @param  string $name the name of the attribute
   * @return Attribute the mapped attribute object or null
   */
  public function getObject(string $name): Attribute {
    if (!$this->isInstantiated($name)) {
      $this->attrs[$name] = $this->gen->createObject($name);
    }
    return $this->attrs[$name];
  }

  /**
   * 
   * @param  Attribute $attr
   * @return $this for a fluent interface
   * @throws InvalidArgumentException
   * @throws IllegalStateException if the attribute is immutable
   */
  public function setInstance(Attribute $attr) {
    $name = $attr->getName();
    if (!$this->getObjectMap()->isValidType($name, $attr)) {
      throw new InvalidArgumentException('Invalid attributetype (' . get_class($attr) . ') for ' . $name . ' attribute.' . $this->gen->getValidType($name) . " expected");
    }
    if (!$this->isProtected($name)) {
      if ($this->isDemanded($name)) {
        $attr->forceVisibility();
      }
      $this->attrs[$name] = $attr;
    } else {
      throw new IllegalStateException("Attribute '$name' is immutable");
    }
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return bool
   */
  public function isIdentifier(string $name): bool {
    if ($this->isInstantiated($name)) {
      return $this->attrs[$name] instanceof IdAttribute;
    }
    return $this->gen->isOfType($name, IdAttribute::class);
  }

  /**
   * 
   * @param string $name
   * @param string $value
   * @return \Sphp\Html\Attributes\IdAttribute
   */
  public function setIdentifier(string $name, string $value = null): IdAttribute {
    if ($this->isIdentifier($name)) {
      $this->attrs[$name]->setValue($value);
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
   * @throws InvalidArgumentException if the attribute name or value is invalid
   * @throws ImmutableAttributeException if the attribute value is unmodifiable
   */
  public function setAttribute(string $name, $value) {
    $this->getObject($name)->setValue($value);
    return $this;
  }

  /**
   * Sets multiple attribute name value pairs
   *
   * For each `$attr => $value` pairs the method calls the {@link self::setAttr()} method
   *
   * @param  mixed[] $attrs an array of attribute name value pairs
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if any of the attributes is invalid
   * @throws ImmutableAttributeException if the value of the attribute is already locked
   */
  public function merge(array $attrs = []) {
    foreach ($attrs as $name => $value) {
      $this->setAttribute($name, $value);
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
      $obj->forceVisibility();
    }
    $this->getObject($name)->forceVisibility();
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
    if (!$this->isInstantiated($name)) {
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
    if (!$this->isInstantiated($name)) {
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
   * @throws InvalidArgumentException if either the name or the value is invalid for the type of the attribute
   * @throws ImmutableAttributeException if the attribute is unmodifiable
   */
  public function protect(string $name, $value) {
    $this->getObject($name)->protectValue($value);
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
    return $this->isInstantiated($name) && $this->getObject($name)->isEmpty();
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute value is protected
   */
  public function remove(string $name) {
    if ($this->isInstantiated($name)) {
      $this->getObject($name)->clear();
    }
    return $this;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   *  Returns `null` if attribute is not present. However some attributes might 
   *  also return `null` values
   *
   * @param  string $name the name of the attribute
   * @return scalar|null the value of the attribute
   */
  public function getValue(string $name) {
    $value = null;
    if ($this->isInstantiated($name)) {
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
  public function isInstantiated(string $name): bool {
    return isset($this->attrs[$name]);
  }

  /**
   * Checks if named attribute instance exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute instance exists and false otherwise
   */
  public function isVisible(string $name): bool {
    if (!$this->isInstantiated($name)) {
      return false;
    } else {
      return $this->getObject($name)->isVisible();
    }
  }

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count(): int {
    return count($this->attrs);
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this->attrs as $name => $attr) {
      if ($attr->isVisible()) {
        $arr[$name] = $attr->getValue();
      }
    }
    return $arr;
  }

}
