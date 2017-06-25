<?php

/**
 * StopWatch.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

/**
 * Implements a simple interface to track the consumed time
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Constructs a new instance
   */
  public function __construct() {
    
  }

  /**
   * Starts the clock from the page request
   *
   * @return self for a fluent interface
   */
  public function startFromRequest() {
    $this->startTime = $_SERVER['REQUEST_TIME_FLOAT'] ?? 0.0;
    return $this;
  }

  /**
   * Starts the timer from the call of this method
   *
   * @return self for a fluent interface
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
  public function getTime(int $precision = 2): float {
    $seconds = microtime(true) - $this->startTime;
    return number_format($seconds, $precision);
  }

  /**
   * Returns the amount of the time from the start of the execution to the
   * current time
   *
   * @param  float $precision number of decimal digits to round to (defaults to 2)
   * @return float the requested time
   */
  public static function getEcecutionTime(int $precision = 2): float {
    $instance = new Static();
    $instance->startFromRequest();
    return $instance->getTime($precision);
  }

}
