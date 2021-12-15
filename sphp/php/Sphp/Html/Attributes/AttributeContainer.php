<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\AttributeException;

/**
 * Implements default attribute manager for all HTML components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AttributeContainer implements Countable, Arrayable, IteratorAggregate {

  /**
   * attributes as a (name -> value) map
   *
   * @var MutableAttribute[]
   */
  private array $attrs = [];
  private AttributeFactory $attrFactory;

  /**
   * Constructor
   * 
   * @param AttributeFactory|null $gen
   */
  public function __construct(?AttributeFactory $gen = null) {
    if ($gen === null) {
      $gen = AttributeFactory::singelton();
    }
    $this->attrFactory = $gen;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->attrs, $this->attrFactory);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attrs = Arrays::copy($this->attrs);
  }

  /**
   * Returns attributes as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString(): string {
    $out = '';
    foreach ($this->attrs as $attr) {
      if ($attr->isVisible()) {
        $out .= ' ' . $attr;
      }
    }
    return trim($out);
  }

  /**
   * Return the attribute generator instance used
   * 
   * @return AttributeFactory the attribute generator instance used
   */
  public function getAttributeFactory(): AttributeFactory {
    return $this->attrFactory;
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
  public function getAttribute(string $name): Attribute {
    if (!$this->contains($name)) {
      $this->attrs[$name] = $this->getAttributeFactory()->createObject($name);
    }
    return $this->attrs[$name];
  }

  /**
   * 
   * @param  Attribute $attr
   * @return $this for a fluent interface
   * @throws AttributeException
   */
  public function setInstance(Attribute $attr) {
    $name = $attr->getName();
    if (!$this->getAttributeFactory()->isValidType($name, $attr)) {
      throw new AttributeException('Invalid attribute type (' . get_class($attr) . ') for ' . $name . ' attribute.' . $this->getAttributeFactory()->getValidType($name) . " expected");
    }
    if (!$this->isProtected($name)) {
      $this->attrs[$name] = $attr;
    } else {
      throw new AttributeException("Attribute '$name' is immutable");
    }
    return $this;
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
  public function setAttribute(string $name, $value) {
    if (isset($this->attrs[$name])) {
      if (!$this->isProtected($name)) {
        $this->attrs[$name]->setValue($value);
      } else {
        throw new ImmutableAttributeException("Attribute $name is immutable attribute");
      }
    } else {
      $this->attrs[$name] = $this->getAttributeFactory()->createObject($name, $value);
    }
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
  public function merge(array $attrs) {
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
  public function forceVisibility(string $name) {
    $this->getAttribute($name)->forceVisibility();
    return $this;
  }

  /**
   * Checks whether an attribute is required or not
   *
   * **Note:** a required attribute either has locked value or the
   * attribute name is required.
   *
   * @param  string $name the name of the attribute
   * @return bool true if the attribute is required and false otherwise
   */
  public function isAlwaysVisible(string $name): bool {
    $isDemanded = false;
    if (isset($this->attrs[$name])) {
      $isDemanded = $this->attrs[$name]->isAlwaysVisible();
    }
    return $isDemanded;
  }

  /**
   * Checks whether given attribute has a locked value on it
   *
   * **Note!:** some attributes can have multiple locked values
   *
   * @param  string $name the name of the attribute
   * @return bool true if the attribute has a locked value on it and false otherwise
   */
  public function isProtected(string $name): bool {
    if (!isset($this->attrs[$name])) {
      return false;
    }
    return $this->attrs[$name] instanceof ImmutableAttribute;
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
    if ($this->isProtected($name)) {
      throw new ImmutableAttributeException("Attribute $name is immutable attribute");
    }
    if ($this->attrFactory->isValidType($name, ImmutableAttribute::class)) {
      $obj = $this->getAttributeFactory()->createImmutableAttribute($name, $value);
      $this->attrs[$name] = $obj;
    } else if ($name === 'class') {
      $this->classes()->protectValue($value);
    }
    return $this;
  }

  /**
   * Checks whether the attribute represents an empty attribute
   * 
   * @param  string $name the name of the attribute
   * @return bool true if the attribute is empty and false otherwise
   */
  public function isEmpty(string $name): bool {
    return $this->contains($name) && $this->getAttribute($name)->isEmpty();
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return $this for a fluent interface
   * @throws ImmutableAttributeException if the attribute value is protected
   */
  public function remove(string $name) {
    if ($this->isProtected($name)) {
      throw new ImmutableAttributeException("Attribute '$name' is immutable and cannot be removed");
    }
    if (isset($this->attrs[$name])) {
      unset($this->attrs[$name]);
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
   * @return string|null the string value of the attribute
   */
  public function getStringValue(string $name): ?string {
    if (!isset($this->attrs[$name])) {
      return null;
    }
    $value = $this->attrs[$name]->getValue();
    if (is_bool($value)) {
      $value = null;
    }
    if ($value !== null) {
      $value = (string) $value;
    }
    return $value;
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
   * @return null|bool|int|float|string the value of the attribute
   */
  public function getValue(string $name) {
    $value = null;
    if (isset($this->attrs[$name])) {
      $value = $this->attrs[$name]->getValue();
    }
    return $value;
  }

  /**
   * Checks if named attribute instance exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return bool true if the attribute instance exists and false otherwise
   */
  public function contains(string $name): bool {
    return isset($this->attrs[$name]);
  }

  /**
   * Checks if named attribute is visible in the output
   *
   * @param  string $name the name of the attribute
   * @return bool true if the attribute is visible and false otherwise
   */
  public function isVisible(string $name): bool {
    $isVisible = false;
    if (isset($this->attrs[$name])) {
      $isVisible = $this->attrs[$name]->isVisible();
    }
    return $isVisible;
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

  /**
   * Returns the class attribute object
   *
   * @return ClassAttribute the `class` attribute object
   */
  public function classes(): ClassAttribute {
    return $this->getAttribute('class');
  }

  /**
   * Returns the style attribute object
   *
   * @return MapAttribute the `style` attribute object
   */
  public function styles(): MapAttribute {
    return $this->getAttribute('style');
  }

  /**
   * Sets an Aria attribute
   *
   * **IMPORTANT!:** Does not alter locked attribute values
   * 
   * @param  string $name the name of the Aria attribute (without the `aria` prefix)
   * @param  mixed $value the value of the attribute
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the attribute name or value is invalid
   * @throws \Sphp\Exceptions\RuntimeException if the attribute value is unmodifiable
   * @link   https://www.w3.org/WAI/intro/aria.php
   */
  public function setAria(string $name, $value) {
    $this->setAttribute("aria-$name", $value);
    return $this;
  }

  /**
   * Returns the `id` attribute
   * 
   * @return IdAttribute
   */
  public function id(): IdAttribute {
    return $this->getAttribute('id');
  }

  /**
   * Returns an external iterator
   *
   * @return Traversable<string, Attribute> external iterator
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->attrs);
  }

}
