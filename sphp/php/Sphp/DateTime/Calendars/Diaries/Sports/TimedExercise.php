<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\ImmutableDuration;

/**
 * Implements a timed exercise like basketball
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class TimedExercise extends Exercise {

  /**
   * Adds a new timed set to the exercise
   * 
   * @param  ImmutableDuration $duration the duration of the exercise set
   * @return TimedSet new instance
   */
  public function addSet($duration) {
    if (!$duration instanceof ImmutableDuration) {
      $duration = ImmutableDuration::from($duration);
    }
    $set = new TimedSet($duration);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total time used in the exercise 
   * 
   * @return ImmutableDuration the total time used in the exercise 
   */
  public function getTotalTime(): ImmutableDuration {
    $time = new ImmutableDuration();
    foreach ($this as $set) {
      $time = $time->add($set->getDuration());
    }
    return $time;
  }

}
