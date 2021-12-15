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
   * @param  Duration $duration the duration of the exercise set
   * @param  float $distance the distance traveled
   * @param  string $unit
   * @return DistanceAndTimeSet added set instance
   */
  public function addSet(Duration $duration, float $distance, string $unit = 'km'): DistanceAndTimeSet {
    $set = new DistanceAndTimeSet($duration, $distance, $unit);
    $this->insertSet($set);
    return $set;
  }

  /**
   * Returns the total time used in the exercise 
   * 
   * @return Duration the total time used in the exercise 
   */
  public function getTotalTime(): Duration {
    $time = new Interval();
    foreach ($this as $set) {
      $time = $time->add($set->getDuration());
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

  /**
   * Returns the average speed
   * 
   * @param int $precision the number of decimal digits to round to
   * @return average speed
   */
  public function getAveragePace(int $precision = 2): float {
    $result = $this->getTotalTime()->toSeconds() / $this->getTotalDistance();

    if ($precision >= 0) {
      return round($result, $precision);
    }
    return $result;
  }

  public function getTotals(): array {
    $totals['total distance'] = $this->getTotalDistance() . ' km';
    $totals['total duration'] = Utils::durationtoString($this->getTotalTime());
    $totals['average speed'] = $this->getAverageSpeed() . ' km/h';
    $ps = $this->getAveragePace();
    $d = \Sphp\DateTime\Intervals::fromSeconds((int) round($ps));
    $pm = round($ps / 60);
    $totals['average pace'] = $d->format('%i:%S') . ' min/km';
    return $totals;
  }

}
