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
   * @param  float $precision number of decimal digits to round to (defaults to 2)
   * @return float the requested time
   */
  public function getTime(int $precision = null): float {
    $seconds = microtime(true) - $this->startTime;
    if ($precision === null) {
      return $seconds;
    }
    return (float) number_format($seconds, $precision);
  }

  /**
   * Returns the amount of the time from the start of the execution to the
   * current time
   *
   * @param  int $precision number of decimal digits to round to (defaults to 2)
   * @return float the requested time
   */
  public static function getExecutionTime(int $precision = null): float {
    $instance = new Static();
    $instance->startFromRequest();
    return $instance->getTime($precision);
  }

}
