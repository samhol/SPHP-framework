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
use Sphp\Stdlib\Datastructures\PriorityQueue;

/**
 * Shutdown process handler, allows you to unregister a process (not supported natively in PHP)
 *
 * Usage:
 * <pre>
 * $sd = new \Sphp\Config\ShutDownRegister();
 * $sd->addCallable(function() {
 *   echo 'foo';
 * }, 10);
 * $sd->addCallable(function() {
 *   echo 'bar';
 * }, 1);
 * $sd->register();
 * </pre>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ShutDownRegister implements IteratorAggregate, \Countable {

  /**
   * @var bool
   */
  private $isRegistered = false;

  /**
   * @var PriorityQueue
   */
  private $callbacks;

  /**
   * Constructor
   */
  public function __construct() {
    $this->callbacks = new PriorityQueue();
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
  public function __invoke(): void {
    foreach ($this->callbacks as $callback) {
      $callback();
    }
  }

  public function addCallable(callable $object, int $priority = 0) {
    $this->callbacks->enqueue($object, $priority);
    return $this;
  }

  /**
   * Unregisters the callbacks
   */
  public function unregisterall() {
    $this->callbacks = new PriorityQueue();
    return $this;
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

  public function getIterator(): Traversable {
    return $this->callbacks->getIterator();
  }

  public function toArray(): array {
    return $this->callbacks->toArray();
  }

  public function count(): int {
    return $this->callbacks->count();
  }

}
