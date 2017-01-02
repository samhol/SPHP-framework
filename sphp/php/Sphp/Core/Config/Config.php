<?php

/**
 * Config.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Config;

use Sphp\Data\Arrayable;
use ArrayAccess;
use Iterator;
use Countable;
use InvalidArgumentException;

/**
 * Application Config class for storing common application data
 *
 * **Note:** Uses Singleton pattern
 *
 * Stored variable names can either be an `integer` or a `string`.
 * Additionally the following <var>$varName</var> casting is equal with the
 * PHP array key casting. The <var>$value</var> can be of any type.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Config implements Arrayable, Iterator, ArrayAccess, Countable {

  /**
   * the singelton instances for defined domains
   *
   * @var Configuration[]
   */
  private static $instances;

  /**
   * the config variable name value pairs container
   *
   * @var array
   */
  private $data = [];

  /**
   * the config variable name value pairs container
   *
   * @var boolean
   */
  private $readonly = false;

  /**
   * Constructs a new instance
   * 
   * @param array[] $config the domain name of the instance
   * @param boolean $readOnly config data is read-only unless this is set to false
   */
  public function __construct(array $config = [], $readOnly = true) {
    foreach ($config as $k => $v) {
      $this->__set($k, $v);
    }
    $this->readonly = (bool) $readOnly;
  }

  public function __destruct() {
    unset($this->data);
  }

  /**
   * Returns the singelton instanse of the {@link self} object
   *
   * @param array[] $config the domain name of the instance
   * @param boolean $readOnly config data is read-only unless this is set to false
   */
  public static function instance($name = 0) {
    if (isset(self::$instances[$name])) {
      return self::$instances[$name];
    }

    $instance = new static([], false);

    self::$instances[$name] = $instance;

    return $instance;
  }

  /**
   * Returns whether Config object is read only or not
   * 
   * @return boolean
   */
  public function isReadOnly() {
    return $this->readonly;
  }

  /**
   * Prevent any more modifications being made to this instance
   * 
   * @return self for PHP Method Chaining
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
   * @param  mixed $varName the name of the variable
   * @return boolean true on success or false on failure
   */
  public function __isset($varName) {
    return array_key_exists($varName, $this->data);
  }

  public function get($name, $default = null) {
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    }
    return $default;
  }

  /**
   * Returns the configuration variable value
   *
   * @param  mixed $varName the name of the variable
   * @return mixed content or `null`
   */
  public function __get($varName) {
    return $this->get($varName, null);
  }

  /**
   * Assigns a value to the specified  configuration variable
   * 
   * The <var>$varName</var> can either be an `integer` or a `string`.
   * Additionally the following <var>$varName</var> casting is equal with the
   * PHP array key casting. The <var>$value</var> can be of any type.
   *
   * @param  mixed $varName the name of the variable
   * @param  mixed $value the value to set
   * @return self for PHP Method Chaining
   */
  public function set($varName, $value) {
    if (!$this->isReadOnly()) {
      if (is_array($value)) {
        $this->data[$varName] = new static($value, $this->readonly);
      } else {
        $this->data[$varName] = $value;
      }
    } else {
      throw new InvalidArgumentException;
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
   * @param  mixed $varName the name of the variable
   * @param  mixed $value the value to set
   */
  public function __set($varName, $value) {
    $this->set($varName, $value);
  }

  /**
   * Unsets the value at the specified variable
   *
   * @param  mixed $name the name of the variable
   * @return self for PHP Method Chaining
   */
  public function __unset($name) {
    if (!$this->isReadOnly()) {
      throw new Exception\InvalidArgumentException('Config is read only');
    } elseif (isset($this->data[$name])) {
      unset($this->data[$name]);
      $this->skipNextIteration = true;
    }
    return $this;
  }

  public function toArray() {
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
   * Merge another Config with this one.
   *
   * For duplicate keys, the following will be performed:
   * - Nested Configs will be recursively merged.
   * - Items in $merge with INTEGER keys will be appended.
   * - Items in $merge with STRING keys will overwrite current values.
   *
   * @param  Config $merge
   * @return Config
   */
  public function merge(Config $merge) {
    foreach ($merge as $key => $value) {
      if (array_key_exists($key, $this->data)) {
        if (is_int($key)) {
          $this->data[] = $value;
        } elseif ($value instanceof self && $this->data[$key] instanceof self) {
          $this->data[$key]->merge($value);
        } else {
          if ($value instanceof self) {
            $this->data[$key] = new static($value->toArray(), $this->allowModifications);
          } else {
            $this->data[$key] = $value;
          }
        }
      } else {
        if ($value instanceof self) {
          $this->data[$key] = new static($value->toArray(), $this->allowModifications);
        } else {
          $this->data[$key] = $value;
        }
      }
    }
    return $this;
  }

  /**
   * Returns the number of the configuraion parameters
   *
   * @return int the number of the configuraion parameters
   */
  public function count() {
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
  public function valid() {
    return $this->key() !== null;
  }

  /**
   * 
   * @param type $offset
   * @return type
   */
  public function offsetExists($offset) {
    return array_key_exists($offset, $this->data);
  }

  /**
   * 
   * @param type $offset
   * @return type
   */
  public function offsetGet($offset) {
    return $this->get($offset);
  }

  /**
   * 
   * @param type $offset
   * @param type $value
   */
  public function offsetSet($offset, $value) {
    $this->__set($offset, $value);
  }

  /**
   * 
   * @param type $offset
   */
  public function offsetUnset($offset) {
    $this->__unset($offset);
  }

}
