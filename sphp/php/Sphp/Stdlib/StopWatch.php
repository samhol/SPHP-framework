<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

/**
 * Implements a simple interface to track the consumed time
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class StopWatch {

  /**
   * the start time
   *
   * @var float
   */
  private $startTime;

  /**
   * Starts the clock from the page request
   *
   * @return $this for a fluent interface
   */
  public function startFromRequest() {
    $this->startTime = $_SERVER['REQUEST_TIME_FLOAT'] ?? 0.0;
    return $this;
  }

  /**
   * Starts the timer from the call of this method
   *
   * @return $this for a fluent interface
   */
  public function start() {
    $this->startTime = microtime(true);
    return $this;
  }

  /**
   * Returns the amount of the time from the constructor call or start call to
   *  the current time
   *
   * @return float the requested time
   */
  public function getTime(): float {
    $seconds = microtime(true) - $this->startTime;
    return $seconds;
  }

  /**
   * Returns the amount of the time from the start of the execution to the
   * current time
   *
   * @return float the requested time
   */
  public static function getExecutionTime(): float {
    $instance = new Static();
    $instance->startFromRequest();
    return $instance->getTime();
  }

}
