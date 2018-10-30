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
use Sphp\Exceptions\OutOfRangeException;
use Sphp\Exceptions\RuntimeException;
use ArrayAccess;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Ini implements Arrayable, ArrayAccess {

  /**
   * previous INI values after init() call
   *
   * @var string[]
   */
  private $pre;

  /**
   * stored INI values
   *
   * @var string[]
   */
  private $ini;

  /**
   * Constructor
   */
  public function __construct() {
    $this->ini = [];
    $this->pre = [];
  }

  /**
   * Destructor
   */
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
   * Returns the stored value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   * @throws OutOfRangeException
   */
  public function get(string $varname) {
    if ($this->exists($varname)) {
      return $this->ini[$varname];
    }
    throw new OutOfRangeException($varname . " is not set");
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return $this for a fluent interface
   * @throws RuntimeException if unable to set INI
   */
  public function init() {
    foreach ($this->ini as $name => $value) {
      $old = ini_set($name, $value);
      if ($old === false) {
        throw new RuntimeException("Unable to set INI value '$name'.");
      }
      $this->pre[$name] = $old;
    }
    return $this;
  }

  /**
   * Executes a callable using settings provided by the instance
   * 
   * **NOTE:** Previous settings are restored after execution 
   * 
   * @param  callable $callable the callable to execute
   * @return mixed the value returned by the given callable
   */
  public function execute(callable $callable) {
    $this->init();
    $callable();
    $this->reset();
    //return $result;
  }

  /**
   * Restores the values of  configuration options
   * 
   * Previous settings restored
   * 
   * @return $this for a fluent interface
   */
  public function reset() {
    foreach ($this->pre as $varname => $value) {
      if ($value !== false) {
        ini_set($varname, $value);
      } else {
        ini_restore($varname);
      }
    }
    $this->pre = [];
    return $this;
  }

  public function toArray(): array {
    return $this->ini;
  }

  public function offsetExists($offset): bool {
    return $this->exists($offset);
  }

  /**
   * Returns the stored value of a configuration option
   * 
   * @param  string $offset the name of the option
   * @return string the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   * @throws OutOfRangeException
   */
  public function offsetGet($offset) {
    return $this->get($offset);
  }

  public function offsetSet($offset, $value) {
    $this->set($offset, $value);
  }

  public function offsetUnset($offset) {
    if ($this->offsetExists($offset)) {
      unset($this->ini[$offset]);
    }
  }

}
