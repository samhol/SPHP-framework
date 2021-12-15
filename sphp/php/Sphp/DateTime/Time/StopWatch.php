<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Time;

use Sphp\DateTime\Exceptions\InvalidStateException;

/**
 * Implements a simple interface to track the consumed time
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class StopWatch {

  /**
   * times in nanoseconds
   *
   * @var int
   */
  private $startTime, $stopTime;

  /**
   * Starts the timer from the call of this method
   *
   * @return $this for a fluent interface
   */
  public function reset() {
    $this->startTime = null;
    $this->stopTime = null;
    return $this;
  }

  /**
   * Starts the timer 
   *
   * @return $this for a fluent interface
   */
  public function start() {
    $this->reset();
    $this->startTime = hrtime(true);
    return $this;
  }

  /**
   * Continues the timer 
   * 
   * @return $this for a fluent interface
   * @throws InvalidStateException if the stopwatch is not started yet
   */
  public function contínue() {
    if ($this->startTime === null) {
      throw new InvalidStateException('The stopwatch is not started yet');
    }
    $this->stopTime = null;
    return $this;
  }

  /**
   * Stops the timer
   *
   * @return $this for a fluent interface
   * @throws InvalidStateException if the stopwatch is not started yet
   */
  public function stop() {
    if ($this->startTime === null) {
      throw new InvalidStateException('The stopwatch is not started yet');
    }
    $this->stopTime = hrtime(true);
    return $this;
  }

  /**
   * Returns the amount of the time from the start to 
   *  the current time 
   *
   * @return int the requested time
   * @throws InvalidStateException if the stopwatch is not started yet
   */
  public function getNanoSeconds(): int {
    if ($this->startTime === null) {
      throw new InvalidStateException('The stopwatch is not started yet');
    }
    $stopTime = $this->stopTime;
    if ($stopTime === null) {
      $stopTime = hrtime(true);
    }
    return $stopTime - $this->startTime;
  }

  /**
   * Returns the amount of the time from the constructor call or start call to
   *  the current time
   *
   * @return float the requested time
   * @throws InvalidStateException if the stopwatch is not started yet
   */
  public function getMilliSeconds(): float {
    return $this->getNanoSeconds() / 1e+6;
  }

  /**
   * Returns the amount of the time from the constructor call or start call to
   *  the current time
   *
   * @return float the requested time
   * @throws InvalidStateException if the stopwatch is not started yet
   */
  public function getSeconds(): float {
    return $this->getNanoSeconds() / 1e+9;
  }

}
