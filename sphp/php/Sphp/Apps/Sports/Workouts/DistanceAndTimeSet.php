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
use Sphp\Apps\Sports\Workouts\Utils;

/**
 * Implements a distance and time set for workout exercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeSet extends TimedSet {

  /**
   * @var float
   */
  private float $distance;

  /**
   * Constructor
   * 
   * @param float $distance
   * @param Duration $duration the duration of the exercise set
   */
  public function __construct(Duration $duration, float $distance, string $unit = 'km') {
    parent::__construct($duration);
    $this->distance = $this->distanceToKm($distance, $unit);
  }

  private function distanceToKm(float $distance, string $unit) {
    if ($unit === 'm') {
      $distance = $distance / 1000;
    }
    return $distance;
  }

  public function getDistance(string $unit = 'km'): float {
    $out = $this->distance;
    if ($unit === 'km') {
      $out = $this->distance / 1000;
    }
    return $out;
  }

  public function getAverageSpeed(): float {
    $hours = $this->getDuration()->toHours();
    return $this->getDistance() / $hours;
  }

  public function toArray(): array {
    $arr = [];
    $arr['distance'] = $this->getDistance() . ' km';
    $arr['duration'] = Utils::durationtoString($this->getDuration());
    $arr['avg. speed'] = round($this->getAverageSpeed(), 2) . ' km/h';
    return $arr;
  }

}
