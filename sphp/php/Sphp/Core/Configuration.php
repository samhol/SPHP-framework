<?php

/**
 * Configuration.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core;

use Sphp\Core\Types\Arrays;
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
class Configuration implements Arrayable {

  /**
   * the singelton instances for defined domains
   *
   * @var Configuration[]
   */
  private static $instances = [];

  /**
   * the singelton instance of the current domain
   *
   * @var Configuration
   */
  private static $current;

  /**
   * the config variable name value pairs container
   *
   * @var array
   */
  private $data;

  /**
   * the PHP configurator instance
   *
   * @var PHPConfiguration
   */
  private $phpConf;

  /**
   * The domain of the instance
   *
   * @var mixed
   */
  private $domain;

  /**
   * Singelton constructor for the {@link self} object
   * 
   * @param  string $domain the domain name of the instance
   */
  protected function __construct($domain, PHPConfiguration $phpConf = null) {
    $this->data = [];
    $this->domain = $domain;
    if ($phpConf === null) {
      $phpConf = new PHPConfiguration();
    }
    $this->phpConf = new PHPConfiguration();
  }

  public function __destruct() {
    unset($this->data, $this->domain, $this->phpConf);
  }

  /**
   * Returns the singelton instanse of the {@link self} object
   *
   * @param  string $domain the name of the used domain
   * @return self the singelton instanse of the config object
   */
  public static function useDomain($domain = 'default') {
    if ($domain === null) {
      if (static::$current === null) {
        $instance = static::useDomain('default');
      } else {
        $instance = static::$current;
      }
    } else if (!array_key_exists($domain, static::$instances)) {
      self::$instances[$domain] = new static($domain);
    }
    static::$current = static::$instances[$domain];
    return static::$instances[$domain];
  }

  /**
   * Returns the configurator instance paired with the current domain
   *
   * @return self the configurator instance paired with the current domain
   */
  public static function current() {
    if (static::$current === null) {
      static::useDomain();
    }
    return static::$current;
  }

  /**
   * Returns the path finder object
   * 
   * @return Path the path finder object
   */
  public function paths() {
    return Path::get();
  }

  /**
   * Returns the name of the domain usedin the curent instance
   *
   * @return string the name of the used domain
   */
  public function getDomainName() {
    return $this->domain;
  }

  /**
   * Checks whether the configuration variable exists
   *
   * @param  mixed $varName the name of the variable
   * @return boolean true on success or false on failure
   */
  public function exists($varName) {
    return array_key_exists($varName, $this->data);
  }

  /**
   * Returns the configuration variable value
   *
   * @param  mixed $varName the name of the variable
   * @return mixed content or `null`
   */
  public function get($varName) {
    if (!$this->exists($varName)) {
      throw new ConfigurationException('Configuration variable can not be found from the current environment');
    }
    return $this->data[$varName];
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
    $this->data[$varName] = $value;
    return $this;
  }

  /**
   * Unsets the value at the specified variable
   *
   * @param  mixed $varName the name of the variable
   * @return self for PHP Method Chaining
   */
  public function remove($varName) {
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

  /**
   * Returns the PHP configuration instance
   * 
   * @return PHPConfiguration the PHP configuration instance
   */
  public function phpConfiguration() {
    return $this->phpConf;
  }
  
  public function toArray() {
    $arr = [];
    $arr[$this->domain]['vars'] = Arrays::copy($this->data);
    $arr[$this->domain]['phpConfiguration'] = $this->phpConf->toArray();
    return $arr;
  }

}
