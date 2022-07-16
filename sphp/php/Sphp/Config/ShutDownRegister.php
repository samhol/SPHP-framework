<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Stdlib\Datastructures\ExecutionSequence;

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
class ShutDownRegister {

  /**
   * @var bool
   */
  private bool $isRegistered = false;

  /**
   * @var ExecutionSequence
   */
  private ExecutionSequence $sequence;

  /**
   * Constructor
   */
  public function __construct() {
    $this->sequence = new ExecutionSequence();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->sequence);
  }

  public function getSequence(): ExecutionSequence {
    return $this->sequence;
  }

  /**
   * Executed by the register_shutdown_function
   */
  public function __invoke(): void {
    $this->sequence->__invoke();
  }

  /**
   * 
   * @param  callable $object
   * @param  int $priority
   * @return $this for a fluent interface
   */
  public function addCallable(callable $object, int $priority = 0) {
    $this->sequence->enqueue($object, $priority);
    return $this;
  }

  /**
   * Register the callback
   * 
   * @return $this instance
   */
  public function register() {
    if (!$this->isRegistered) {
      register_shutdown_function($this);
    }
    $this->isRegistered = true;
    return $this;
  }

}
