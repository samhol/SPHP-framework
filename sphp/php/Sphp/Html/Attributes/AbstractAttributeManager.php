<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use IteratorAggregate;
use Sphp\Html\IdentifiableInterface as IdentifiableInterface;
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
class AbstractAttributeManager implements IdentifiableInterface, Countable, IteratorAggregate {

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
   *
   * @var string[] 
   */
  private $identifiers = [];

  /**
   * Constructs a new instance
   *
   */
  public function __construct(array $objectMap = []) {
    foreach ($objectMap as $objType) {
      $this->setAttributeObject($objType);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrObjects, $this->attrs, $this->locked, $this->required);
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
  public function setAttributeObject(AttributeInterface $attrObject) {
    $name = $attrObject->getName();
    if ($this->isAttributeObject($name)) {
      throw new InvalidAttributeException();
    }
    if ($this->exists($name)) {
      $attrObject->set($this->get($name));
      if ($this->isDemanded($name)) {
        $attrObject->demand();
      }
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
   * Checks whether the instance of the inner attribute object if it is mapped
   *
   * @param  string $attrName the name of the attribute
   * @return boolean true if the attribute is an instance of {@link AttributeInterface} false otherwise
   */
  public function isIdentifier($attrName) {
    return in_array($attrName, $this->identifiers);
  }

  /**
   * Checks whether the instance of the inner attribute object if it is mapped
   *
   * @param  string $attrName the name of the attribute
   * @return boolean true if the attribute is an instance of {@link AttributeInterface} false otherwise
   */
  public function isIdentified($attrName) {
    return $this->isIdentifier($attrName) && $this->isLocked($attrName);
  }

  /**
   * Attaches whether the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the identifying attribute
   * @return self for PHP Method Chaining
   */
  public function attachIdentifier($name) {
    if ($this) {
      
    }
    if (!$this->isIdentifier($name)) {
      $this->identifiers[] = $name;
    }
    return $this;
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

  public function validateAttributeName($name) {
    return Strings::match($name, "/^[a-zA-Z][\w:.-]*$/");
  }

  /**
   * Sets an attribute name value pair
   *
   * **IMPORTANT!:** Does not alter locked attribute values:
   *
   * 1. For 'class' attribute: if a CSS class name is locked the method does nothing
   * 2. For any other locked attribute the method throws a {@link UnmodifiableAttributeException}
   *
   * `$value` parameter:
   *
   * 1. the type of the value should always convert to string
   * 2. `null` or an empty `string`: an empty attribute is set
   * 3. boolean `true`: an empty attribute is set
   * 4. boolean `false`: attribute is removed or an attribute object is cleared
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
      if ($this->isIdentifier($name)) {
        $this->setId($name, $value);
      }
      if ($value instanceof AttributeInterface) {
        $this->setAttributeObject($value);
      } else if ($value === false) {
        $this->remove($name);
      } else {
        $this->attrs[$name] = $value;
      }
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hasId($identityName = "id") {
    return $this->isIdentifier($identityName) && $this->exists($identityName);
  }

  /**
   * {@inheritdoc}
   */
  public function identify($identityName = "id", $prefix = "id_", $length = 16) {
    if (!$this->isLocked($identityName)) {
      $value = $prefix . Strings::random($length);
      while (!$row = HtmlIdStorage::get()->store($identityName, $value)) {
        $value = $prefix . Strings::random($length);
      }
      $this->lock($identityName, $value);
      $this->attachIdentifier($identityName);
      // var_dump($this->attrs[$identityName]);
    }
    return $this->get($identityName);
  }

  /**
   * {@inheritdoc}
   */
  public function setId($identityName, $value) {
   // var_dump(HtmlIdStorage::get());
    $result = false;
    if ($this->isLocked($identityName)) {
      throw new UnmodifiableAttributeException("The value of the '$identityName' attribute is unmodifiable");
    }
    if (!HtmlIdStorage::get()->isValidValue($value)) {
      throw new InvalidAttributeException("Attribute value is illegal");
    }
    //var_dump(HtmlIdStorage::get()->exists($identityName, $value));
    $result = HtmlIdStorage::get()->store($identityName, $value);
    echo "id: $identityName \n";
    var_dump($result);
   // var_dump(HtmlIdStorage::get()->exists($identityName, $value));
    //var_dump(HtmlIdStorage::get()->exists("foo", $value));
    //var_dump(HtmlIdStorage::get()->exists("id", $value));
    if ($result) {
      $this->lock($identityName, $value);
      $this->attachIdentifier($identityName);
    }
    return $result;
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
   * 
   * @param  string $name the name of the attribute
   * @return boolean
   */
  public function isHidden($name) {
    return $this->exists($name) && $this->get($name) === false;
  }

  /**
   * 
   * @param  string $name the name of the attribute
   * @return boolean
   */
  public function isEmpty($name) {
    return $this->exists($name) && $this->get($name) == "";
  }

  /**
   * Removes the given attribute if it is not required
   *
   * @param  string $name the name of the attribute
   * @return self for PHP Method Chaining
   * @throws UnmodifiableAttributeException if the attribute is unremovable
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
      $value = $this->get($name);
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
   *
   * @return \ArrayIterator
   */
  public function getIterator() {
    $arr = array_merge($this->attrObjects, $this->attrs);
    $it = new \ArrayIterator($arr);
    return $it;
  }

}
