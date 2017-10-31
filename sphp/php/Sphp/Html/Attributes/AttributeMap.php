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
class AttributeMap {

  /**
   * attribute object type map as a (attribute name -> attribute object type) map
   *
   * @var mixed[]
   */
  private $map = [];

  /**
   * @var string 
   */
  private $defaultType;
  private static $c = 0;

  /**
   * Constructs a new instance
   *
   * @param array $objectMap
   * @param string $defaultType
   */
  public function __construct(string $defaultType = AttributeInterface::class) {
    $this->defaultType = $defaultType;
    self::$c++;
    //var_dump(self::$c);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->map);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->flags = Arrays::copy($this->map);
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
   * @param  string $type
   * @return $this for a fluent interface
   * @throws AttributeException
   */
  public function mapObject(string $name, string $type, array $params = []) {
    if (!$this->isValidType($name, $type)) {
      throw new AttributeException("Attribute name: '$name' must extend type : '{$this->getActualType($name)}'");
    }
    array_unshift($params, $name);
    $this->map[$name] = ['type' => $type, 'params' => $params];
    return $this;
  }

  public function mapPattrenAttribute(string $name, string $attrObject) {
    //new 
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  public function getActualType(string $name): string {
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
  public function getParametersFor(string $name): array {
    if ($this->isMapped($name)) {
      return $this->map[$name]['params'];
    } else {
      return [];
    }
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  public function getValidType(string $name): string {
    if ($this->isMapped($name)) {
      return $this->map[$name]['type'];
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
      return is_subclass_of($new, $this->map[$name]['type']);
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
    return isset($this->map[$name]);
  }

  /**
   * Returns the instance of the inner attribute object if it is mapped
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   */
  public function createObject(string $name): AttributeInterface {
    print_r($this->map);
    $type = $this->getActualType($name);
    $params = $this->getParametersFor($name);
    $class = new \ReflectionClass($type);
    $instance = $class->newInstanceArgs($params);
    return $instance;
  }

  /**
   * Counts the number of the attributes stored in the manager
   *
   * @return int the number of the attributes stored
   */
  public function count(): int {
    return count($this->map);
  }

}



