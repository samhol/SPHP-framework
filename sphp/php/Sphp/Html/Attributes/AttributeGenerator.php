<?php

/**
 * AbstractAttributeManager.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

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
class AttributeGenerator {

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

  //private static $c = 0;

  /**
   * Constructs a new instance
   *
   * @param string $defaultType
   */
  public function __construct(string $defaultType = AttributeInterface::class) {
    $this->defaultType = $defaultType;
    //self::$c++;
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
    $this->map = Arrays::copy($this->map);
  }

  /**
   * Maps a distinct attribute object type with an attribute name
   * 
   * **IMPORTANT:** 
   * 
   *  If attribute in the manager has already an attribute object instance the 
   *    new object must be of the same type
   * 
   * @param  string $name the name of the attribute
   * @param  string $type the object type of the attribute
   * @param  mixed $param optional parameters injected to the generated object
   * @return $this for a fluent interface
   * @throws InvalidAttributeException if the requested attribute type is invalid
   */
  public function mapType(string $name, string $type, ...$param) {
    if (!$this->isValidType($name, $type)) {
      throw new InvalidAttributeException("Attribute '$name' must extend type : '{$this->getActualType($name)}'");
    }
    array_unshift($param, $name);
    $this->map[$name] = ['type' => $type, 'params' => $param];
    return $this;
  }

  /**
   * Maps a pattern object type with an attribute name
   * 
   * @param  string $name
   * @param  string $pattern
   * @return $this for a fluent interface
   * @throws InvalidAttributeException
   */
  public function mapPatternAttribute(string $name, string $pattern) {
    $this->mapType($name, PatternAttribute::class, $pattern);
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  public function getActualType(string $name): string {
    $type = $this->getValidType($name);
    if ($type === AttributeInterface::class) {
      $type = Attribute::class;
    }
    return $type;
  }

  /**
   * Returns the parameters of the mapped attribute
   * 
   * @param  string $name the name of the attribute
   * @return array the parameters of the mapped attribute
   */
  public function getParametersFor(string $name): array {
    if ($this->isMapped($name)) {
      return $this->map[$name]['params'];
    } else {
      return [$name];
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
    return is_a($new, $this->getValidType($name), true);
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
   * Returns a new instance of the attribute object
   *
   * @param  string $name the name of the attribute
   * @return AttributeInterface the mapped attribute object or null
   */
  public function createObject(string $name): AttributeInterface {
    $type = $this->getActualType($name);
    $params = $this->getParametersFor($name);

    //print_r($params);
    $class = new \ReflectionClass($type);
    $instance = $class->newInstanceArgs($params);
    return $instance;
  }

}

