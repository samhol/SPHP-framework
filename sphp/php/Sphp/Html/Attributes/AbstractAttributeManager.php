<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use ArrayAccess;
use IteratorAggregate;
use SplObjectStorage;
use Sphp\Core\Types\Arrays as Arrays;
use Sphp\Core\Types\Strings as Strings;

/**
 * Class contains and manages all the attribute value pairs for a markup language tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractAttributeManager implements AttributeChanger, AttributeChangeObserver, Countable, ArrayAccess, IteratorAggregate {

  /**
   * attributes as a (name -> value) map
   *
   * @var mixed[]
   */
  private $attrs = [];

  /**
   * locked attributes
   *
   * @var scalar[]
   */
  private $locked = [];

  /**
   * required attribute names as name => name pairs
   *
   * @var string[]
   */
  private $required = [];

  /**
   * attribute objects
   *
   * @var AttributeInterface[]
   */
  private $attrObjects = [];

  /**
   * collection of individual id change observer objects
   *
   * @var SplObjectStorage
   */
  private $observers;

  /**
   * Constructs a new instance
   *
   */
  public function __construct(array $objectMap = []) {
    foreach ($objectMap as $objType) {
      $this->setAttributeObject($objType);
    }
    $this->observers = new SplObjectStorage();
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrObjects, $this->attrs, $this->locked, $this->required, $this->observers);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->attrObjects = Arrays::copy($this->attrObjects);
    $this->attrs = Arrays::copy($this->attrs);
    $this->locked = Arrays::copy($this->locked);
    $this->required = Arrays::copy($this->required);
    $this->observers = new SplObjectStorage();
  }

  /**
   * Returns all attribute - value pairs as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString() {
    $output = "";
    foreach (array_keys($this->attrs) as $name) {
      $output .= " " . $this->attrToString($name);
    }
    foreach ($this->attrObjects as $attr) {
      $output .= " " . $attr;
    }
    return trim($output);
  }

  /**
   * Attaches an {@kink AttributeInterface} object to the manager
   * 
   * @param  AttributeInterface $attrObject
   * @return self for PHP Method Chaining
   * @throws InvalidAttributeException
   */
  private function setAttributeObject(AttributeInterface $attrObject) {
    $name = $attrObject->getName();
    if ($this->isAttributeObject($name) && $this->getAttributeObject($name)) {
      throw new InvalidAttributeException();
    }
    if ($this->exists($name)) {
      $attrObject->set($this->getValue($name));
      if ($this->isDemanded($name)) {
        $attrObject->demand();
      }
      $attrObject->attachAttributeChangeObserver($this);
    }
    $this->attrObjects[$name] = $attrObject;
    return $this;
  }

  /**
   * Checks whether the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute is an instance of {@link AttributeInterface} false otherwise
   */
  public function isAttributeObject($name) {
    return array_key_exists($name, $this->attrObjects);
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface|null the mapped attribute object or null
   */
  protected function getAttributeObject($name) {
    $obj = null;
    if (array_key_exists($name, $this->attrObjects)) {
      $obj = $this->attrObjects[$name];
    }
    return $obj;
  }

  /**
   * Returns the class attribute object
   *
   * @return MultiValueAttribute the class attribute object
   */
  public function classes() {
    return $this->getAttributeObject("class");
  }

  /**
   * Returns the style attribute object
   *
   * @return PropertyAttribute the style attribute object
   */
  public function inlineStyles() {
    return $this->getAttributeObject("style");
  }

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   * 1. For 'class' attribute: if a CSS class name is locked the method does nothing
   * 2. For any other locked attribute the method throws a {@link UnmodifiableAttributeException}
   *
   * **`$value` handling:**
   *
   * 1. the type of the value should always convert to string
   * 2. `null` or an empty `string`: an empty attribute is set
   * 3. boolean `true`: an empty attribute is set
   * 4. boolean `false`: attribute is removed
   * 5. otherwise the attribute value is the string conversion value
   *
   * @param  string $name the name of the attribute
   * @param  mixed $value the value of the attribute
   * @return self for PHP Method Chaining
   * @throws InvalidAttributeException if the attribute name or value is invalid
   * @throws UnmodifiableAttributeException if the attribute value is unmodifiable
   */
  public function set($name, $value = true) {
    if ($this->isAttributeObject($name)) {
      $this->getAttributeObject($name)->set($value);
    } else {
      if (!Strings::match($name, "/^[a-zA-Z][\w:.-]*$/")) {
        throw new InvalidAttributeException("Malformed Attribute name '$name'");
      }
      if ($this->isLocked($name)) {
        throw new UnmodifiableAttributeException("The value of the '$name' attribute is unmodifiable");
      }
      if ($value instanceof AttributeInterface) {
        $this->setAttributeObject($value);
      }
      if ($value === false) {
        $this->remove($name);
      } else {
        $this->attrs[$name] = $value;
        $this->notifyAttributeChange($name);
      }
    }
    return $this;
  }
  /**
   * Creates an an unique id attribute
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. This method randomizes
   * the id attribute value creation so that the id should be unique.
   *
   * @param  string $seed id attributes seed
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_global_id.asp id attribute
   */
  public function setUnique($name, $seed = "") {
    if ($this->isAttributeObject($name)) {
      throw new UnmodifiableAttributeException("The value of the '$name' attribute is unmodifiable");
    }
    return $this->set($name, $seed . Strings::generateRandomString());
  }

  /**
   * Sets the given attribute name as required
   *
   * **IMPORTANT:** A required attribute cannot be removed but its value is still mutable
   *
   * @param  string $name the name of the required attribute
   * @return self for PHP Method Chaining
   */
  public function demand($name) {
    if ($this->isAttributeObject($name)) {
      $this->getAttributeObject($name)->demand();
    } else {
      if (!$this->exists($name)) {
        $this->set($name, true);
      }
      $this->required[$name] = $name;
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
  public function isDemanded($name) {
    if ($this->isAttributeObject($name)) {
      $required = $this->getAttributeObject($name)->isDemanded();
    } else {
      $required = in_array($name, $this->required) || $this->isLocked($name);
    }
    return $required;
  }

  /**
   * Checks whether given attribute has a locked value on it
   *
   * **Note!: ** some attributes can have multiple locked values (CSS classes,
   * inline styles etc.).
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute has a locked value on it and false otherwise
   */
  public function isLocked($name) {
    if ($this->isAttributeObject($name)) {
      $locked = $this->getAttributeObject($name)->isLocked();
    } else {
      $locked = array_key_exists($name, $this->locked);
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
   * 3. Attribute values follow the rules defined in {@link self::setAttr()}.
   *
   * @param  string $name the name of the attribute
   * @param  mixed $value the new locked value of the attribute
   * @return self for PHP Method Chaining
   * @throws   InvalidAttributeException if the attribute name or value is invalid
   * @throws   UnmodifiableAttributeException if the attribute value is unmodifiable
   */
  public function lock($name, $value) {
    if ($this->isAttributeObject($name)) {
      $this->getAttributeObject($name)->lock($value);
    } else {
      if ($this->isLocked($name)) {
        throw new UnmodifiableAttributeException("The value of the '$name' attribute is unmodifiable");
      }
      $this->set($name, $value);
      $this->locked[$name] = $value;
    }
    return $this;
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param    string $name the name of the attribute
   * @return   self for PHP Method Chaining
   * @throws   UnmodifiableAttributeException if the attribute is unremovable
   * @triggers {@link AttributeChangeEvent} for each removed attribute
   */
  public function remove($name) {
    if ($this->isAttributeObject($name)) {
      $this->getAttributeObject($name)->clear();
    } else {
      if ($this->isLocked($name)) {
        throw new UnmodifiableAttributeException("Locked attribute '$name' cannot be removed");
      } else if ($this->isDemanded($name)) {
        throw new UnmodifiableAttributeException("Required attribute '$name' cannot be removed");
      } else if ($this->exists($name)) {
        unset($this->attrs[$name]);
        $this->notifyAttributeChange($name);
      }
    }
    return $this;
  }

  /**
   * Removes all not locked and not required attributes
   *
   * @return self for PHP Method Chaining
   * @triggers {@link AttributeChangeEvent} for each removed attribute
   */
  public function clear() {
    foreach ($this->attrObjects as $attr) {
      $attr->clear();
    }
    foreach (array_keys($this->attrs) as $attrName) {
      if (!$this->isDemanded($attrName)) {
        $this->remove($attrName);
      }
    }
    return $this;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return mixed the value of the attribute or the attribute object
   */
  public function get($name) {
    if ($this->isAttributeObject($name)) {
      $value = $this->getAttributeObject($name);
    } else if (!$this->exists($name)) {
      $value = false;
    } else {
      $value = $this->attrs[$name];
    }
    return $value;
  }

  /**
   * Returns the value of a given attribute name
   *
   * **IMPORTANT:**
   *
   * * Returns always `boolean false` if attribute is not present.
   * * return `null` or an empty string for empty attributes.
   *
   * @param  string $name the name of the attribute
   * @return mixed the value of the attribute or the attribute object
   */
  public function getValue($name) {
    if ($this->isAttributeObject($name)) {
      $value = $this->getAttributeObject($name)->getValue();
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
   * @return boolean true if the atribute exists and false otherwise
   */
  public function exists($name) {
    return array_key_exists($name, $this->attrs) || array_key_exists($name, $this->attrObjects);
  }

  /**
   * Parses the given attribute value pair to a HTML valid attribute string
   *
   * @param  string $name the name of the attribute
   * @return string HTML valid attribute string
   */
  public function attrToString($name) {
    if ($this->isAttributeObject($name)) {
      $output = "{$this->getAttributeObject($name)}";
    } else if ($this->exists($name)) {
      $output = "$name";
      $value = $this->getValue($name);
      if ($value !== true && Strings::notEmpty($value)) {
        $strVal = Strings::toString($value);
        $output .= '="' . htmlspecialchars($strVal, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, "utf-8", false) . '"';
      }
    } else {
      $output = "";
    }
    return $output;
  }

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count() {
    $num = count(array_unique(array_merge($this->required, array_keys($this->attrs))));
    foreach ($this->attrObjects as $obj) {
      if ($obj->isVisible()) {
        $num++;
      }
    }
    return $num;
  }

  /**
   * {@inheritdoc}
   */
  public function attachAttributeChangeObserver($observer) {
    $this->observers->attach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function detachAttributeChangeObserver($observer) {
    $this->observers->detach($observer);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function notifyAttributeChange($attrName) {
    foreach ($this->observers as $obs) {
      if ($obs instanceof AttributeChangeObserver) {
        $obs->attributeChanged($this, $attrName);
      } else {
        $obs($this, $attrName);
      }
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function attributeChanged(AttributeChanger $obj, $name) {
    echo "$name";
    if ($this[$name] == $obj) {
      $this->notifyAttributeChange($this, $name);
    }
    return $this;
  }

  public function offsetExists($offset) {
    return $this->exists($offset);
  }

  public function offsetGet($name) {
    if ($this->isAttributeObject($name)) {
      $value = $this->getAttributeObject($name);
    } else if (!$this->exists($name)) {
      $value = false;
    } else {
      $value = $this->attrs[$name];
    }
    return $value;
  }

  public function offsetSet($offset, $value) {
    $this->set($offset, $value);
  }

  public function offsetUnset($offset) {
    $this->remove($offset);
  }

  /**
   *
   * @return \ArrayIterator
   */
  public function getIterator() {
    $arr = array_merge($this->attrObjects, $this->attrs);
    $it = new \ArrayIterator($arr);
    return $it;
  }

}
