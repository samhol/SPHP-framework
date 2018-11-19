<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\Interval;

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
   * @param  Interval|string $time the duration of the exercise set
   * @return TimedSet new instance
   */
  public function addSet($time) {
    $set = new TimedSet($time);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total time used in the exercise 
   * 
   * @return Interval the total time used in the exercise 
   */
  public function getTotalTime(): Interval {
    $time = 0;
    foreach ($this as $set) {
      $time += $set->getDuration()->i * 60 + $set->getDuration()->h * 60 * 60 + $set->getDuration()->d * 60 * 60 * 24;
    }
    echo "PT{$time}S" . ", ";
    return new Interval("PT{$time}S");
  }

}
