<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use IteratorAggregate;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Strings;
use ArrayIterator;
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
class AbstractAttributeManager implements Countable, IteratorAggregate {

  const REQUIRED = 0b1;
  const LOCKED = 0b11;

  /**
   * attributes as a (name -> value) map
   *
   * @var mixed[]
   */
  private $attrs = [];

  /**
   * Attribute flags for scalar attributes
   * 
   * @var int[]
   */
  private $flags = [];

  /**
   * attribute objects
   *
   * @var AttributeObjectManager
   */
  private $attrObjects;

  /**
   * Constructs a new instance
   *
   */
  public function __construct(AttributeObjectManager $objectMap = null) {
    if ($objectMap === null) {
      $objectMap = new AttributeObjectManager();
    }
    $this->attrObjects = $objectMap;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrObjects, $this->attrs, $this->flags);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attrObjects = clone $this->attrObjects;
    $this->attrs = Arrays::copy($this->attrs);
    // $this->locked = Arrays::copy($this->locked);
    //$this->required = Arrays::copy($this->required);
    $this->flags = Arrays::copy($this->flags);
  }

  /**
   * Returns all attribute - value pairs as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString(): string {
    $output = '';
    foreach (array_keys($this->attrs) as $name) {
      $output .= ' ' . $this->attrToString($name);
    }
    $output .= ' ' . $this->attrObjects;
    return trim($output);
  }

  /**
   * Returns the inner attribute object manager
   *
   * @return AttributeObjectManager the inner attribute object manager
   */
  protected function getObjectManager(): AttributeObjectManager {
    return $this->attrObjects;
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
    if ($this->attrObjects->contains($name)) {
      $this->attrObjects->getObject($name)->set($value);
    } else if (is_scalar($value)) {
      if (!preg_match('/^[a-zA-Z][\w:.-]*$/', $name)) {
        throw new AttributeException("Malformed Attribute name '$name'");
      }
      if ($this->isLocked($name)) {
        throw new ImmutableAttributeException("The value of the '$name' attribute is unmodifiable");
      }
      if ($value === false || $value === null) {
        $this->remove($name);
      } else {
        $this->attrs[$name] = $value;
        if (!array_key_exists($name, $this->flags)) {
          $this->flags[$name] = 0;
        }
      }
    }
    return $this;
  }

  protected function setNew(string $name, $value) {
    $this->attrs[$name] = $value;
    $this->flags[$name] = 0;
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
    if ($this->attrObjects->contains($name)) {
      $this->attrObjects->getObject($name)->demand();
    } else {
      if (!$this->exists($name)) {
        $this->set($name, true);
      }
      //$this->required[$name] = $name;
      $this->flags[$name] |= static::REQUIRED;
    }
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
    if ($this->attrObjects->contains($name)) {
      $required = $this->attrObjects->getObject($name)->isDemanded();
    } else {
      //$required = in_array($name, $this->required) || $this->isLocked($name);
      $required = array_key_exists($name, $this->flags) && static::REQUIRED & $this->flags[$name] === static::REQUIRED;
    }
    return $required;
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
    if ($this->attrObjects->contains($name)) {
      $locked = $this->attrObjects->getObject($name)->isLocked();
    } else {
      //$locked = array_key_exists($name, $this->locked);
      $locked = array_key_exists($name, $this->flags) && static::LOCKED & $this->flags[$name] === static::LOCKED;
    }
    return $locked;
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
    if ($this->attrObjects->contains($name)) {
      $this->attrObjects->getObject($name)->lock($value);
    } else {
      if ($this->isLocked($name)) {
        throw new ImmutableAttributeException("The value of the '$name' attribute is unmodifiable");
      }
      if ($value === false || $value === null) {
        throw new AttributeException('NULL and boolean FALSE values cannot be locked');
      }
      $this->set($name, $value);
      //$this->locked[$name] = $value;
      $this->flags[$name] |= static::LOCKED;
    }
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
   * @throws \Sphp\Exceptions\RuntimeException if the attribute is not removable
   */
  public function remove(string $name) {
    if ($this->attrObjects->contains($name)) {
      $this->attrObjects->getObject($name)->clear();
    } else {
      if ($this->isLocked($name)) {
        throw new ImmutableAttributeException("Locked attribute '$name' cannot be removed");
      } else if ($this->isDemanded($name)) {
        throw new ImmutableAttributeException("Required attribute '$name' cannot be removed");
      } else if ($this->exists($name)) {
        unset($this->attrs[$name]);
      }
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
    if ($this->attrObjects->contains($name)) {
      $this->attrObjects->getObject($name)->getValue();
    } else if (!$this->exists($name)) {
      $value = false;
    } else {
      $value = $this->attrs[$name];
    }
    return $value;
  }

  /**
   * Checks if an attribute name exists in the manager
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute exists and false otherwise
   */
  public function exists(string $name): bool {
    return array_key_exists($name, $this->attrs) || ($this->attrObjects->contains($name) && $this->attrObjects->getObject($name)->isVisible());
  }

  /**
   * Parses the given attribute value pair to a HTML valid attribute string
   *
   * @param  string $name the name of the attribute
   * @return string HTML valid attribute string
   */
  public function attrToString(string $name): string {
    if ($this->attrObjects->contains($name)) {
      $output = $this->attrObjects->attrToString($name);
    } else if ($this->exists($name)) {
      $output = "$name";
      $value = $this->get($name);
      if ($value !== true && !Strings::isEmpty($value)) {
        $strVal = Strings::toString($value);
        $output .= '="' . htmlspecialchars($strVal, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, "utf-8", false) . '"';
      }
    } else {
      $output = '';
    }
    return $output;
  }

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count(): int {
    $num = count($this->attrs);
    return $num + $this->attrObjects->count();
  }

  /**
   *
   * @return \Traversable
   */
  public function getIterator(): \Traversable {
    $arr = array_merge($this->attrObjects->toArray(), $this->attrs);
    $it = new ArrayIterator($arr);
    return $it;
  }

}
