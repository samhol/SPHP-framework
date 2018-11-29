<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\Duration;

/**
 * Implements a distance and time exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeExercise extends Exercise {

  /**
   * Returns the total distance
   * 
   * @return float the distance
   */
  public function getTotalDistance(): float {
    $distance = 0;
    foreach ($this as $set) {
      $distance += $set->getDistance();
    }
    return $distance;
  }

  /**
   * Adds a new exercise set
   * 
   * @param  float $distance the distance traveled
   * @param  Duration|string $duration the duration of the exercise set
   * @param  string $unit
   * @return DistanceAndTimeSet added set instance
   */
  public function addSet(float $distance, $duration, string $unit = 'km'): DistanceAndTimeSet {
    if (!$duration instanceof Duration) {
      $duration = Duration::from($duration);
    }
    $set = new DistanceAndTimeSet($distance, $duration, $unit);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total time used in the exercise 
   * 
   * @return Duration the total time used in the exercise 
   */
  public function getTotalTime(): Duration {
    $time = new Duration();
    foreach ($this as $set) {
      $time->add($set->getDuration());
    }
    return $time;
  }

  /**
   * Returns the average speed
   * 
   * @param int $precision the number of decimal digits to round to
   * @return average speed
   */
  public function getAverageSpeed(int $precision = 2): float {
    $result = $this->getTotalDistance() / $this->getTotalTime()->toHours();
    if ($precision >= 0) {
      return round($result, $precision);
    }
    return $result;
  }

}
