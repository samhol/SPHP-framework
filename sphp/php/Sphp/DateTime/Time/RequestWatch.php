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
class RequestWatch {

  /**
   * Returns the clock from the page request
   *
   * @return float starttime in seconds
   */
  public function getRequestStart(): ?float {
    if (!isset($_SERVER, $_SERVER['REQUEST_TIME_FLOAT'])) {
      throw new InvalidStateException('The RequestWatch failed to start');
    }
    $startTime = $_SERVER['REQUEST_TIME_FLOAT'];
    return $startTime;
  }

  /**
   * Returns the amount of the time from the constructor call or start call to
   *  the current time
   *
   * @return float the requested time
   */
  public function getTime(): float {
    $seconds = microtime(true) - $this->getRequestStart();
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
    return $instance->getTime();
  }

}
