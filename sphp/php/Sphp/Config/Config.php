<?php

/**
 * Config.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config;

use Sphp\Stdlib\Datastructures\Arrayable;
use ArrayAccess;
use Iterator;
use Countable;
use Sphp\Config\Exceptions\ConfigurationException;

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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Config implements Arrayable, Iterator, ArrayAccess, Countable {

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
   * Constructs a new instance
   * 
   * @param array[] $config the domain name of the instance
   * @param boolean $readOnly configuration data is read-only unless this is set to false
   */
  public function __construct(array $config = [], bool $readOnly = true) {
    foreach ($config as $k => $v) {
      $this->__set($k, $v);
    }
    $this->readonly = $readOnly;
  }

  public function __destruct() {
    unset($this->data);
  }

  /**
   * Returns the singleton instance of the {@link self} object
   *
   * @param  string $name
   * @param  array $data
   * @return Config
   */
  public static function instance(string $name = null, array $data = []): Config {
    if ($name === null) {
      $name = 0;
    }
    if (isset(self::$instances[$name])) {
      return self::$instances[$name];
    }

    $instance = new static($data, false);

    self::$instances[$name] = $instance;

    return $instance;
  }

  /**
   * Returns whether the instance is read only or not
   * 
   * @return boolean
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
   * Checks whether the configuration variable exists
   *
   * @param  string $varName the name of the variable
   * @return boolean true on success or false on failure
   */
  public function __isset(string $varName): bool {
    return $this->contains($varName);
  }

  public function get(string $varName, $default = null) {
    if (array_key_exists($varName, $this->data)) {
      return $this->data[$varName];
    }
    return $default;
  }

  /**
   * Checks whether the configuration variable exists
   *
   * @param  string $varName the name of the variable
   * @return boolean true on success or false on failure
   */
  public function contains(string $varName): bool {
    return isset($this->data[$varName]) || array_key_exists($varName, $this->data);
  }

  /**
   * Returns the configuration variable value
   *
   * @param  string $varName the name of the variable
   * @return mixed content or `null`
   */
  public function __get(string $varName) {
    return $this->get($varName, null);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * @param  string $varName the name of the variable
   * @param  mixed $value the value to set
   * @return $this for a fluent interface
   * @throws ConfigurationException if the object is read only
   */
  public function set(string $varName, $value) {
    if (!$this->isReadOnly()) {
      if (is_array($value)) {
        $this->data[$varName] = new static($value, $this->isReadOnly());
      } else {
        $this->data[$varName] = $value;
      }
    } else {
      throw new ConfigurationException('Configuration object is read only');
    }
    return $this;
  }

  /**
   * Merge another Configuration object with this one
   *
   * @param  Config $merged
   * @return $this for a fluent interface
   * @throws ConfigurationException if the object is read only
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
   * The <var>$varName</var> can either be an `integer` or a `string`.
   * Additionally the following <var>$varName</var> casting is equal with the
   * PHP array key casting. The <var>$value</var> can be of any type.
   *
   * @param  string $varName the name of the variable
   * @param  mixed $value the value to set
   * @throws ConfigurationException if the object is read only
   */
  public function __set(string $varName, $value) {
    $this->set($varName, $value);
  }

  /**
   * Removes the value at the specified variable
   *
   * @param  string $name the name of the variable
   * @return $this for a fluent interface
   * @throws ConfigurationException if the object is read only
   */
  public function remove(string $name) {
    if (!$this->isReadOnly()) {
      throw new ConfigurationException('Configuration object is read only');
    } else if (isset($this->data[$name])) {
      unset($this->data[$name]);
      $this->skipNextIteration = true;
    }
    return $this;
  }

  /**
   * Unsets the value at the specified variable
   *
   * @param  string $name the name of the variable
   * @return $this for a fluent interface
   * @throws ConfigurationException if the object is read only
   */
  public function __unset(string $name) {
    $this->remove($name);
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

  /**
   * 
   * @return mixed
   */
  public function current() {
    $this->skipNextIteration = false;
    return current($this->data);
  }

  /**
   * 
   * @return mixed
   */
  public function key() {
    return key($this->data);
  }

  /**
   * 
   */
  public function next() {
    if ($this->skipNextIteration) {
      $this->skipNextIteration = false;
      return;
    }
    next($this->data);
  }

  /**
   * 
   */
  public function rewind() {
    $this->skipNextIteration = false;
    reset($this->data);
  }

  /**
   * 
   * @return boolean
   */
  public function valid(): bool {
    return $this->key() !== null;
  }

  /**
   * 
   * @param  mixed $offset
   * @return boolean
   */
  public function offsetExists($offset): bool {
    return $this->contains($offset);
  }

  /**
   * 
   * @param  string $offset
   * @return mixed the value at the 
   */
  public function offsetGet($offset) {
    return $this->get($offset);
  }

  /**
   * 
   * @param string $offset
   * @param mixed $value
   */
  public function offsetSet($offset, $value) {
    $this->set($offset, $value);
  }

  /**
   * 
   * @param string $offset
   */
  public function offsetUnset($offset) {
    $this->remove($offset);
  }

}
