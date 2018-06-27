<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use DateInterval;

/**
 * Implements a timed exercise like basketball
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimedExercise extends Exercise {

  /**
   * Adds a new timed set to the exercise
   * 
   * @param DateInterval|string $time the duration of the exercise set
   */
  public function addSet($time) {
    $this->insertSet(new TimedSet($time));
  }

  /**
   * Returns the distance
   * 
   * @return float the distance
   */
  public function getTotalTime(): float {
    $distance = 0;
    foreach ($this as $set) {
      $distance += $set->getDuration();
    }
    return $distance;
  }

}
