<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\InvalidArgumentException;
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

  // private static $c = 0;

  /**
   * Constructor
   *
   * @param string $defaultType
   */
  public function __construct(string $defaultType = Attribute::class) {
    $this->defaultType = $defaultType;
    // self::$c++;
    // var_dump(self::$c);
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
   * @throws InvalidArgumentException if the requested attribute type is invalid
   */
  public function mapType(string $name, string $type, ...$param) {
    if (!$this->isValidType($name, $type)) {
      throw new InvalidArgumentException("Attribute '$name' must extend type : '{$this->getValidType($name)}', $type given");
    }
    array_unshift($param, $name);
    $this->map[$name] = ['type' => $type, 'params' => $param];
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return string
   */
  public function getActualType(string $name): string {
    $type = $this->getValidType($name);
    if ($type === Attribute::class) {
      $type = GeneralAttribute::class;
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
   * @param string $name
   * @param type $type
   * @return bool
   */
  public function isOfType(string $name, $type): bool {
    return $this->getActualType($name) instanceof $type;
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
   * @return Attribute the mapped attribute object or null
   */
  public function createObject(string $name): Attribute {
    $type = $this->getActualType($name);
    $params = $this->getParametersFor($name);
    $class = new \ReflectionClass($type);
    $instance = $class->newInstanceArgs($params);
    return $instance;
  }

}
