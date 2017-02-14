<?php

/**
 * Ini.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Config;

use Sphp\Data\Arrayable;
use Sphp\Core\Types\Arrays;

/**
 * Implements class for managing PHP settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
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
   * @param  string $value the new value for the option
   * @return self for PHP Method Chaining
   * @link   http://php.net/manual/en/function.ini-set.php ini_set
   * @link   http://php.net/manual/en/ini.list.php list of all available options
   */
  public function set($name, $value) {
    $this->ini[$name] = $value;
    return $this;
  }

  /**
   * Returns the current value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string  the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   */
  public function get($varname) {
    return $this->ini[$varname];
  }

  /**
   * Returns the current value of a configuration option
   * 
   * @param  string $varname the name of the option
   * @return string  the value of the option
   * @link   http://php.net/manual/en/function.ini-get.php ini_get
   */
  public function getCurrent($varname) {
    return ini_get($varname);
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return self for PHP Method Chaining
   */
  public function init() {
    foreach ($this->ini as $name => $value) {
      $this->pre[$name] = ini_set($name, $value);
    }
    return $this;
  }

  /**
   * Initializes all PHP settings defined by the instance
   * 
   * Previous settings are replaced
   * 
   * @return self for PHP Method Chaining
   */
  public function reset() {
    foreach ($this->pre as $name => $value) {
      ini_set($name, $value);
    }
    $this->pre = [];
    return $this;
  }

  public function toArray() {
    return Arrays::copy($this->ini);
  }

}
