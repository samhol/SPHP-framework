<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Stdlib\Datastructures\ObjectStorage;

/**
 * Shutdown process handler, allows you to unregister a process (not supported natively in PHP)
 *
 * Usage:
 * <pre>
 * $sd = new System_ShutdownProcess($callable);
 * $sd->register() /// $sd->unregister()
 * or via factory
 * $sd = System_ShutdownProcess::factory($callable)->register()
 * </pre>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ShutDownRegister implements IteratorAggregate {

  /**
   * @var bool
   */
  private $isRegistered = false;

  /**
   * @var ObjectStorage
   */
  private $callbacks;

  /**
   * Constructor
   */
  public function __construct() {
    $this->callbacks = new ObjectStorage();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->callbacks);
  }

  /**
   * Executed by the register_shutdown_function
   */
  public function __invoke() {
    foreach ($this->callbacks as $callback) {
      $callback();
    }
  }

  public function addCallable(callable $object): string {
    $id = spl_object_hash($object);
    $this->callbacks->attach($object);
    return $id;
  }

  public function contains(callable $object): string {
    $this->callbacks->containsObject($object);
  }

  public function removeObject(callable $callback) {
    $this->callbacks->remove($callback);
    return $this;
  }

  /**
   * Unregisters the callbacks
   */
  public function unregisterall() {
    $this->callbacks = new ObjectStorage();
  }

  /**
   * Register the callback
   * 
   * @return System_ShutdownProcess $this instance
   */
  public function register() {
    if (!$this->isRegistered) {
      register_shutdown_function($this);
    }
    $this->isRegistered = true;
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

  public function getIterator(): Traversable {
    return new ArrayIterator($this->callbacks);
  }

  public function toArray(): array {
    return $this->callbacks;
  }

}
