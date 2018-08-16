<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateInterval;

/**
 * Implements a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Interval extends DateInterval implements IntervalInterface {

  /**
   * Constructor
   * 
   * @param string $interval an interval specification.
   */
  public function __construct(string $interval = 'P0D') {
    parent::__construct($interval);
    $this->recalculate();
  }

  /**
   * 
   * @return DateInterval
   */
  public function getInterval(): DateInterval {
    return $this;
  }

  /**
   * Recalculates the values
   * 
   * @return void
   */
  protected function recalculate() {
    $seconds = $this->toSeconds();
    $this->y = floor($seconds / 60 / 60 / 24 / 365.2525);
    $seconds -= $this->y * 31536000;
    $this->m = floor($seconds / 60 / 60 / 24 / 30.4167);
    $seconds -= $this->m * 2592000;
    $this->d = floor($seconds / 60 / 60 / 24);
    $seconds -= $this->d * 86400;
    $this->h = floor($seconds / 60 / 60);
    $seconds -= $this->h * 3600;
    $this->i = floor($seconds / 60);
    $seconds -= $this->i * 60;
    $this->s = $seconds;
  }

  public function toSeconds(): float {
    $days = $this->days;
    if ($days === false) {
      $days = floor($this->y * 365.2525);
      $days += floor($this->m * 30.4167);
      $days += $this->d;
    }
    return ($days * 24 * 60 * 60 +
            $this->h * 60 * 60 +
            $this->i * 60 +
            $this->s) * ($this->invert ? -1 : 1);
  }

  public function toMinutes(): float {
    return ($this->toSeconds() / 60);
  }

  public function toHours(): float {
    return ($this->toMinutes() / 60);
  }

  public function toDays(): float {
    return ($this->toSeconds() / 86400);
  }

  public function isNegative(): bool {
    return $this->invert === 1;
  }

  /**
   * 
   * 
   * @param  string $time
   * @return Interval new instance
   */
  public static function createFromDateString($time) {
    $di = parent::createFromDateString($time);
    return Intervals::FromDateInterval($di);
  }

}
