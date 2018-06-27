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
 * Description of DistanceAndTimeExercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeExercise extends Exercise implements \Iterator {

  public function __construct(string $name, string $category) {
    parent::__construct($name, $category);
  }

  /**
   * Returns the distance
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
   * @param float $distance the distance traveled
   * @param DateInterval|string $duration the duration of the exercise set
   * @param string $unit
   */
  public function addSet(float $distance, $duration, string $unit = 'km') {
    $this->insertSet(new DistanceAndTimeSet($distance, $duration, $unit));
  }

  public function getSets(): array {
    return $this->sets;
  }
  /**
   * Returns the distance
   * 
   * @return float the distance
   */
  public function getTotalTime(): float {
    $distance = 0;
    foreach ($this as $set) {
      $distance += $set->getHours();
    }
    return $distance;
  }

  public function getAverageSpeed(): string {
    $d = $this->getTotalDistance();
    $t = $this->getTotalTime();
    return $d/$t;
  }

}
