<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Config;

/**
 * Shutdown process handler, allows you to unregister a process (not supported natively in PHP)
 *
 * Usage:
 * $sd = new System_ShutdownProcess($callable);
 * $sd->register() /// $sd->unregister()
 * or via factory
 * $sd = System_ShutdownProcess::factory($callable)->register()
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ShutDownregister {

  /**
   * Callback to be executed by the shutdown function
   * @var callble $callback
   */
  private $callbacks;

  /**
   * Create a shutdown process
   * 
   * @param callable $callback
   */
  public function __construct($callback) {
    if (!is_callable($callback)) {
      throw new \Exception('Callback must be of a callable type');
    }
    $this->callbacks = $callback;
    $this->callbacks = [];
  }

  public function __destruct() {
    unset($this->callbacks);
  }
  /**
   * Executed by the register_shutdown_function
   */
  public function __call() {
    foreach($this->callbacks as $callback) {
      $callback();
    }
  }
  
  public function addCallable(callable $object) {
    
  }

  /**
   * Unregister the callback
   */
  public function unregister() {
    $this->callbacks = null;
  }

  /**
   * Register the callback
   * 
   * @return System_ShutdownProcess $this instance
   */
  public function register() {
    register_shutdown_function(array($this, 'call'));
    return $this;
  }

  /**
   * Factory method for shutdown process
   * 
   * @param callable $callback
   * @return System_ShutdownProcess $sd_process
   */
  public static function factory($callback) {
    $obj = new self($callback);
    return $obj;
  }

}
