<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use IteratorAggregate;
use Countable;
use Sphp\Config\Exceptions\ConfigurationException;
use Sphp\Exceptions\RuntimeException;

/**
 * Application Configuration class for storing common application data
 *
 * **Note:** Uses Singleton pattern
 *
 * Stored variable names can either be an `integer` or a `string`.
 * Additionally the following <var>$varName</var> casting is equal with the
 * PHP array key casting. The <var>$value</var> can be of any type.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Config implements Arrayable, IteratorAggregate, ArrayAccess, Countable {

  /**
   * the singleton instances for defined domains
   *
   * @var Configuration[]
   */
  private static $instances;

  /**
   * the configuration variable name value pairs container
   *
   * @var array
   */
  private $data = [];

  /**
   * readonly flag
   *
   * @var boolean
   */
  private $readonly = false;

  /**
   * Constructor
   * 
   * @param array[] $config configuration data
   * @param boolean $readOnly configuration data is read-only unless this is set to false
   */
  public function __construct(array $config = [], bool $readOnly = true) {
    foreach ($config as $k => $v) {
      $this->__set($k, $v);
    }
    $this->readonly = $readOnly;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->data);
  }

  /**
   * Returns whether the instance is read only or not
   * 
   * @return boolean true if the instance is read only and false otherwise
   */
  public function isReadOnly(): bool {
    return $this->readonly;
  }

  /**
   * Prevent any more modifications being made to this instance
   * 
   * @return $this for a fluent interface
   */
  public function setReadOnly() {
    $this->readonly = true;
    foreach ($this->data as $value) {
      if ($value instanceof self) {
        $value->setReadOnly();
      }
    }
    return $this;
  }

  /**
   * Checks whether the specific configuration variable exists
   *
   * @param  string $varname the name of the variable
   * @return boolean true on success or false on failure
   */
  public function __isset(string $varname): bool {
    return $this->contains($varname);
  }

  public function get(string $varName, $default = null) {
    if (array_key_exists($varName, $this->data)) {
      return $this->data[$varName];
    }
    return $default;
  }

  /**
   * Checks whether the specific configuration variable exists
   *
   * @param  string $varname the name of the variable
   * @return boolean true on success or false on failure
   */
  public function contains(string $varname): bool {
    return isset($this->data[$varname]) || array_key_exists($varname, $this->data);
  }

  /**
   * Returns the configuration variable value
   *
   * @param  string $varname the name of the variable
   * @return mixed content or `null`
   */
  public function __get(string $varname) {
    return $this->get($varname, null);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $varname the name of the variable
   * @param  mixed $value the value to set
   * @return $this for a fluent interface
   * @throws RuntimeException if the object is read only
   */
  public function set(string $varname, $value) {
    if (!$this->isReadOnly()) {
      if (is_array($value)) {
        $this->data[$varname] = new static($value, $this->isReadOnly());
      } else {
        $this->data[$varname] = $value;
      }
    } else {
      throw new RuntimeException('Configuration object is read only');
    }
    return $this;
  }

  /**
   * Merge another Configuration object with this one
   *
   * @param  Config $merged
   * @return $this for a fluent interface
   * @throws RuntimeException if the object is read only
   */
  public function merge(Config $merged) {
    foreach ($merged as $varName => $value) {
      $this->set($varName, $value);
    }
    return $this;
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $varname the name of the variable
   * @param  mixed $value the value to set
   * @throws RuntimeException if the object is read only
   */
  public function __set(string $varname, $value) {
    $this->set($varname, $value);
  }

  /**
   * Unsets the specified variable
   *
   * @param  string $varname the name of the variable
   * @return $this for a fluent interface
   * @throws RuntimeException if the object is read only
   */
  public function remove(string $varname) {
    if ($this->isReadOnly()) {
      throw new RuntimeException('Configuration object is read only');
    } else if (isset($this->data[$varname])) {
      unset($this->data[$varname]);
    }
    return $this;
  }

  /**
   * Unsets the specified variable
   *
   * @param  string $varname the name of the variable
   * @return $this for a fluent interface
   * @throws ConfigurationException if the object is read only
   */
  public function __unset(string $varname) {
    $this->remove($varname);
    return $this;
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this->data as $k => $v) {
      if (!$v instanceof Config) {
        $arr[$k] = $v;
      } else {
        $arr[$k] = $v->toArray();
      }
    }
    return $arr;
  }

  /**
   * Returns the number of the configuration parameters
   *
   * @return int the number of the configuration parameters
   */
  public function count(): int {
    return count($this->data);
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->data);
  }

  /**
   * Checks whether the specific configuration variable exists
   * 
   * @param  string $varname the name of the variable
   * @return boolean true on success or false on failure
   */
  public function offsetExists($varname): bool {
    return $this->contains($varname);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $varname the name of the variable
   * @return mixed the value of the given offset
   */
  public function offsetGet($varname) {
    return $this->get($varname);
  }

  /**
   * Assigns a value to the specified configuration variable
   * 
   * @param  string $varname the name of the variable
   * @param  mixed $value the value to set
   * @return void
   * @throws RuntimeException if the object is read only
   */
  public function offsetSet($varname, $value): void {
    $this->set($varname, $value);
  }

  /**
   * Unsets the specified variable
   * 
   * @param  string $varname the name of the variable
   * @return void
   * @throws RuntimeException if the configuration object is read only
   */
  public function offsetUnset($varname): void {
    $this->remove($varname);
  }

  /**
   * Returns named singleton instance of the configuration object
   *
   * @param  string $name name of the singleton instance
   * @param  array $data the configuration data
   * @return Config singleton instance
   */
  public static function instance(string $name = null, array $data = []): Config {
    if ($name === null) {
      $name = 0;
    }
    if (!isset(self::$instances[$name])) {
      self::$instances[$name] = new static($data, false);
    }
    return self::$instances[$name];
  }

}
