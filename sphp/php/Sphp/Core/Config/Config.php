<?php

/**
 * Config.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Config;

use Sphp\Data\Arrayable;

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
class Config implements Arrayable {

  /**
   * the singelton instances for defined domains
   *
   * @var Configuration[]
   */
  private static $instances = [];

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
  private $locked = false;

  /**
   * Constructs a new instance
   * 
   * @param  array[] $config the domain name of the instance
   * @param type $locked
   */
  public function __construct(array $config = [], $locked = true) {
    foreach ($config as $k => $v) {
      $this->__set($k, $v);
    }

    $this->locked = (bool) $locked;
  }

  public function __destruct() {
    unset($this->data);
  }

  /**
   * Returns the singelton instanse of the {@link self} object
   *
   * @param  string $domain the name of the used domain
   * @return self the singelton instanse of the config object
   */
  public static function domain($domain = 0) {
    if (!array_key_exists($domain, static::$instances)) {
      self::$instances[$domain] = new static();
    }
    return static::$instances[$domain];
  }

  public function isLocked() {
    return $this->locked;
  }

  public function lock($lock) {
    $this->locked = $lock;
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
    return $this->get($varName);
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
  public function __set($varName, $value) {
    if (!$this->isLocked()) {
      if (is_array($value)) {
        $this->data[$varName] = new static($value, $this->locked);
      } else {
        $this->data[$varName] = $value;
      }
    } else {
      throw new \Sphp\Core\ConfigurationException;
    }
    return $this;
  }

  /**
   * Unsets the value at the specified variable
   *
   * @param  mixed $varName the name of the variable
   * @return self for PHP Method Chaining
   */
  public function __unset($varName) {
    if ($this->exists($varName)) {
      unset($this->data[$varName]);
    }
    return $this;
  }

  /**
   * Returns the string representation of the configuration data
   *
   * @return string the string representation of the configuration data
   */
  public function __toString() {
    return var_export($this->data, true);
  }

  public function toArray() {
    $arr = [];
    foreach ($this as $k => $v) {
      if (!$v instanceof Config) {
        $arr[$k] = $v;
      } else {
        $arr[$k] = $v->toArray();
      }
    }
    return $arr;
  }

}
