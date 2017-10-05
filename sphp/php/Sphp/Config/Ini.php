<?php

/**
 * Ini.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config;

use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\OutOfRangeException;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Ini implements Arrayable {

  /**
   * the ini 
   *
   * @var string[]
   */
  private $pre = [];

  /**
   * the ini 
   *
   * @var string[]
   */
  private $ini = [];

  public function __destruct() {
    unset($this->ini, $this->pre);
  }

  /**
   * Sets the value of a configuration option
   * 
   * The configuration option will keep this new value during the script's 
   * execution, and will be restored at the script's ending.
   * 
   * **Not all the available options can be changed**
   * 
   * @param  string $name the name of the option
   * @param  scalar $value the new value for the option
   * @return $this for a fluent interface
   * @link   http://php.net/manual/en/function.ini-set.php ini_set
   * @link   http://php.net/manual/en/ini.list.php list of all available options
   */
  public function set(string $name, $value) {
    $this->ini[$name] = (string) $value;
    return $this;
  }

  /**
   * Checks whether the option is set in this configuration object
   * 
   * 
   * @param  string $name the name of the option
   * @return boolean true if the ini variable is set in this configuration
   * @link   http://php.net/manual/en/function.ini-set.php ini_set
   * @link   http://php.net/manual/en/ini.list.php list of all available options
   */
  public function exists(string $name): bool {
    return isset($this->ini[$name]);
  }

  /**
   * Returns the current value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   * @throws OutOfRangeException
   */
  public function get(string $varname) {
    if ($this->exists($varname)) {
      return $this->ini[$varname];
    }throw new OutOfRangeException();
  }

  /**
   * Returns the current value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string  the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   */
  public function getCurrent(string $varname) {
    return ini_get($varname);
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return $this for a fluent interface
   */
  public function init() {
    foreach ($this->ini as $name => $value) {
      $this->pre[$name] = ini_set($name, $value);
    }
    return $this;
  }

  /**
   * Executes a function using a custom PHP configuration
   * 
   * @param  callable $callable the code to execute using the given settings
   * @return mixed the value returned by the given callable
   */
  public function execute(callable $callable) {
    $this->init();
    $result = $callable();
    $this->reset();
    return $result;
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return $this for a fluent interface
   */
  public function reset() {
    foreach ($this->pre as $name => $value) {
      ini_set($name, $value);
    }
    $this->pre = [];
    return $this;
  }

  public function toArray(): array {
    return Arrays::copy($this->ini);
  }

}
