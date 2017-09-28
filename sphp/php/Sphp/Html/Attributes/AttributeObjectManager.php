<?php

/**
 * AttributeObjectInjector.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Countable;
use Iterator;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Exceptions\RuntimeException;

/**
 * Description of AttributeObjectInjector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeObjectManager implements Countable, Iterator {

  /**
   * @var string 
   */
  private $defaultType;

  /**
   * attribute object type map as a (attribute name -> attribute object type) map
   *
   * @var string[]
   */
  private $map = [];

  /**
   * attribute objects
   *
   * @var AttributeInterface[]
   */
  private $attrObjects = [];

  /**
   * Constructs a new instance
   *
   * @param array $objectMap
   * @param string $defaultType
   */
  public function __construct(array $objectMap = [], string $defaultType = AttributeInterface::class) {
    $this->defaultType = $defaultType;
    foreach ($objectMap as $key => $objType) {
      $this->mapObject($key, $objType);
    }
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->attrObjects, $this->map);
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
  }

  /**
   * Returns all attribute - value pairs as formatted text for tag implementation
   *
   * @return string all attributes as formatted text
   */
  public function __toString(): string {
    $output = '';
    foreach ($this->attrObjects as $attr) {
      $output .= ' ' . $attr;
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
   * @param  AttributeInterface $attrObject
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\RuntimeException
   */
  protected function mapObject(string $name, string $attrObject) {
    if (!$this->isValidType($name, $attrObject)) {
      throw new RuntimeException("Attribute name: '$name' must be of type : '{$this->getValidType($name)}'");
    }
    $this->map[$name] = $attrObject;
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  protected function getValidType(string $name): string {
    if ($this->isMapped($name)) {
      return $this->getMappedType($name);
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
    return is_subclass_of($new, $this->getValidType($name));
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
   * @return string the mapped attribute object type name
   * @throws InvalidArgumentException
   */
  public function getMappedType(string $name): string {
    if (!$this->isMapped($name)) {
      throw new InvalidArgumentException("Attribute '$name' is not mapped as an object");
    }
    return $this->map[$name];
  }

  /**
   * Checks whether the attribute name is instance created 
   *
   * @param  string $name the name of the attribute
   * @return boolean true if the attribute is an instance of {@link AttributeInterface} false otherwise
   */
  public function isObject(string $name): bool {
    return array_key_exists($name, $this->attrObjects);
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object
   * @throws InvalidArgumentException
   */
  protected function createObject(string $name): AttributeInterface {
    if (!$this->isMapped($name)) {
      throw new InvalidArgumentException("Attribute '$name' is not mapped as an object");
    }
    $type = $this->getMappedType($name);
    return new $type($name);
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   */
  public function getObject(string $name): AttributeInterface {
    if (!$this->isMapped($name)) {
      throw new InvalidArgumentException("Attribute '$name' is not mapped as an object");
    }
    if (!$this->isObject($name)) {
      $this->attrObjects[$name] = $this->createObject($name);
    }
    return $this->attrObjects[$name];
  }
  /**
   * 
   * @param  string $name
   * @return string
   * @throws InvalidArgumentException
   */
  public function attrToString(string $name): string  {
    if ($this->isObject($name)) {
      return $this->getObject($name)->getHtml();
    } else if ($this->isMapped($name)) {
      return '';
    } else {
      throw new InvalidArgumentException();
    }
  }
          

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count(): int {
    $num = 0;
    foreach ($this->attrObjects as $obj) {
      if ($obj->isVisible()) {
        $num++;
      }
    }
    return $num;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->attrObjects);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->attrObjects);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->attrObjects);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->attrObjects);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->attrObjects);
  }

}
