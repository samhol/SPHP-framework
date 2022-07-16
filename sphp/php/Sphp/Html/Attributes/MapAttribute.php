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

use ArrayAccess;
use IteratorAggregate;
use Traversable;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\NullPointerException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeValueException;

/**
 * Implements an property attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MapAttribute extends AbstractAttribute implements ArrayAccess, IteratorAggregate, CollectionAttribute {

  /**
   * properties as a (name -> value) map
   *
   * @var scalar[]
   */
  private array $props = [];
  private PropertyParser $parser;

  /**
   * whether the attribute is required or not
   *
   * @var boolean
   */
  private bool $required = false;

  /**
   * Constructor
   * 
   * @param string $name the name of the attribute
   * @param PropertyParser $parser
   */
  public function __construct(string $name, ?PropertyParser $parser = null) {
    parent::__construct($name);
    if ($parser === null) {
      $parser = PropertyParser::singelton();
    }
    $this->parser = $parser;
  }

  public function __destruct() {
    unset($this->props, $this->parser);
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

  public function forceVisibility() {
    $this->required = true;
    return $this;
  }

  public function isAlwaysVisible(): bool {
    return $this->required;
  }

  public function isVisible(): bool {
    return $this->isAlwaysVisible() || !empty($this->props);
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
   * Sets an property name value pair
   *
   * **Note:** Replaces old mutable property value with the new one
   *
   * @param  string $property the name of the property
   * @param  string|int|float $value the value of the property
   * @return $this for a fluent interface
   * @throws InvalidAttributeValueException if the property name or value is invalid
   */
  public function setProperty(string $property, string|int|float $value) {
    if (!$this->parser->isValidProperty($property, $value)) {
      throw new InvalidAttributeValueException("Property ($property: $value) is not valid");
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
   * @param  iterable<string, scalar> $props new property name value pairs
   * @return $this for PHP Method Chaining
   * @throws InvalidAttributeValueException if any of the properties has empty name or value
   */
  public function setProperties(iterable $props) {
    foreach ($props as $property => $value) {
      $this->setProperty($property, $value);
    }
    return $this;
  }

  /**
   * Removes given property
   *
   * @param  string ...$propName the name of the property to remove
   * @return $this for a fluent interface
   */
  public function unsetProperties(string ...$propName) {
    foreach ($propName as $name) {
      unset($this->props[$name]);
    }
    return $this;
  }

  public function clear() {
    $this->props = [];
    return $this;
  }

  /**
   * Determines whether the given property exists
   *
   * @param  string $property the name of the property
   * @return bool true if the property exists and false otherwise
   */
  public function hasProperty(string $property): bool {
    return isset($this->props[$property]);
  }

  /**
   * Returns the value of the property name
   *
   * @param  string $property the name of the property
   * @return string|int|float|null the value of the property
   * @throws NullPointerException if the property does not exist
   */
  public function getProperty(string $property): string|int|float|null {
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
    $value = null;
    if (!$this->isEmpty()) {
      $value = $this->parser->propertiesToString($this->props);
    }
    return $value;
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
   * @return bool true if the property exists and false otherwise
   */
  public function offsetExists(mixed $property): bool {
    return $this->hasProperty($property);
  }

  /**
   * Returns the value of the property name or null if the property does not exist
   *
   * @param  string $property the name of the property
   * @return scalar|null the value of the property or null if the property does not exists
   */
  public function offsetGet(mixed $property): mixed {
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
  public function offsetSet(mixed $property, mixed $value): void {
    $this->setProperty($property, $value);
  }

  /**
   * Removes given property
   *
   * @param  string $property the name of the property to remove
   * @return void
   * @throws ImmutableAttributeException if the property is immutable
   */
  public function offsetUnset(mixed $property): void {
    $this->unsetProperties($property);
  }

  public function toArray(): array {
    return $this->props;
  }

  public function getIterator(): Traversable {
    yield from $this->props;
  }

}
