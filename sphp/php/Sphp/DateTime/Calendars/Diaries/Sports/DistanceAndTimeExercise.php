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
 * Implements a distance and time exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeExercise extends Exercise implements \Iterator {

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
   * @param  DateInterval|string $duration the duration of the exercise set
   * @param  string $unit
   * @return DistanceAndTimeSet new instance
   */
  public function addSet(float $distance, $duration, string $unit = 'km'): DistanceAndTimeSet {
    $set = new DistanceAndTimeSet($distance, $duration, $unit);
    $this->insertSet($set);
    return $set;
  }

  public function getSets(): array {
    return $this->sets;
  }

  /**
   * Returns the total time used
   * 
   * @return float the total time used
   */
  public function getTotalTime(): float {
    $distance = 0;
    foreach ($this as $set) {
      $distance += $set->getHours();
    }
    return $distance;
  }

  /**
   * Returns the average speed
   * 
   * @param int $precision the number of decimal digits to round to
   * @return average speed
   */
  public function getAverageSpeed(int $precision = 2): float {
    $result = $this->getTotalDistance() / $this->getTotalTime();
    if ($precision >= 0) {
      return round($result, $precision);
    }
    return $result;
  }

  public function totalsToString(): string {
    return $this->getTotalDistance() . "km, at " . $this->getAverageSpeed() . "km/h";
  }

}
