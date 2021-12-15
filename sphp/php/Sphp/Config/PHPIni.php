<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Config\Exception\ConfigurationException;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPIni {

  /**
   * previous INI values after init() call
   *
   * @var string[]
   */
  private array $pre;

  /**
   * stored INI values
   *
   * @var string[]
   */
  private array $ini;

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
   * @link   https://www.php.net/manual/en/function.ini-set.php ini_set
   * @link   https://www.php.net/manual/en/ini.list.php list of all available options
   */
  public function set(string $name, $value) {
    $this->ini[$name] = $value;
    return $this;
  }

  /**
   * Checks whether the option is set in this configuration object
   * 
   * 
   * @param  string $name the name of the option
   * @return bool true if the ini variable is set in this configuration
   * @link   https://www.php.net/manual/en/function.ini-set.php ini_set
   * @link   https://www.php.net/manual/en/ini.list.php list of all available options
   */
  public function contains(string $name): bool {
    return isset($this->ini[$name]);
  }

  /**
   * Returns the stored value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string the value of the option
   * @link   https://www.php.net/manual/en/function.ini-get.php ini_get
   * @throws ConfigurationException
   */
  public function get(string $varname) {
    if ($this->contains($varname)) {
      return $this->ini[$varname];
    }
    throw new ConfigurationException($varname . " is not set");
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return $this for a fluent interface
   * @throws ConfigurationException if unable to set INI
   */
  public function init() {
    foreach ($this->ini as $name => $value) {
      $old = ini_set($name, (string) $value);
      if ($old === false) {
        throw new ConfigurationException("Unable to set INI value '$name'.");
      }
      if (!array_key_exists($name, $this->pre)) {
        $this->pre[$name] = $old;
      }
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
      ini_set($varname, $value);
    }
    $this->pre = [];
    return $this;
  }

  public function remove(string $offset) {
    if ($this->contains($offset)) {
      unset($this->ini[$offset]);
    }
    return $this;
  }

}
