<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use DateInterval as Dt;

/**
 * Implements a date interval
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateInterval extends Dt {

  /**
   * Constructor
   * 
   * @param type $interval_spec an interval specification.
   */
  public function __construct($interval_spec) {
    parent::__construct($interval_spec);
    $this->recalculate();
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

  /**
   * Returns the interval as seconds
   * 
   * @return float the interval as seconds
   */
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

}
