<?php

/**
 * Timer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Util;

/**
 * Implements a simple interface to track the consumed time
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Timer {

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
    $this->start();
  }

  /**
   * Starts the clock from the page request
   *
   * @return self for PHP Method Chaining
   */
  public function startFromRequest() {
    $this->startTime = filter_input(\INPUT_SERVER, "REQUEST_TIME_FLOAT", \FILTER_SANITIZE_NUMBER_INT);
    return $this;
  }

  /**
   * Starts the timer from the call of this method
   *
   * @return self for PHP Method Chaining
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
  public function getTime() {
    return microtime(true) - $this->startTime;
  }

  /**
   * Returns the amount of the time from the start of the execution to the
   * current time
   *
   * @param  float $precision the optional number of decimal digits to round to
   * @return float the requested time
   */
  public static function getEcecutionTime($precision = false) {
    $time = 0;
    if (array_key_exists("REQUEST_TIME_FLOAT", $_SERVER)) {
      $time = microtime(true) - intval($_SERVER["REQUEST_TIME_FLOAT"]);
    }
    if ($precision !== false) {
      $time = round($time, $precision);
    }
    return $time;
  }

}
