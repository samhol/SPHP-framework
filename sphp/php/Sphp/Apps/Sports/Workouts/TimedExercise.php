<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;

use Sphp\DateTime\Duration;
use Sphp\DateTime\Interval;
use Sphp\Apps\Sports\Workouts\Utils;

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
   * @param  Duration $duration the duration of the exercise set
   * @return TimedSet new instance
   */
  public function addSet(Duration $duration) {
    $set = new TimedSet($duration);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total time used in the exercise 
   * 
   * @return Duration the total time used in the exercise 
   */
  public function getTotalDuration(): Duration {
    $time = new Interval();
    foreach ($this as $set) {
      $time = $time->add($set->getDuration());
    }
    return $time;
  }

  public function getTotals(): array {
    $tot['duration'] = Utils::durationtoString($this->getTotalDuration());
    return $tot;
  }

}
