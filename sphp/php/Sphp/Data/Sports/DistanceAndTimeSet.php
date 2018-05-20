<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

/**
 * Description of DistanceAndTimeSet
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeSet {

  /**
   * @var float
   */
  private $distance;

  /**
   * @var string
   */
  private $unit = 'm';

  /**
   * @var string
   */
  private $time;

  /**
   * Constructor
   * 
   * @param float $distance
   * @param type $time
   * @param string $unit
   */
  public function __construct(float $distance, $time, string $unit = 'm') {
    $this->setDistance($distance, $unit)->setTime($time);
  }

  public function __toString() {
    return sprintf("%s%s in %s time", $this->distance, $this->unit, $this->time);
  }

  public function getDistance(string $unit = 'm'): float {
    if ($unit !== $this->unit) {

      $distance *= 1000;
    }
    return $this->distance;
  }

  public function getReps(): int {
    return $this->reps;
  }

  public function setDistance(float $distance, string $unit = 'm') {
    $this->distance = $distance;
    $this->unit = $unit;
    return $this;
  }

  public function setUnit(string $unit) {
    $this->unit = $unit;
    return $this;
  }

  public function setTime($reps) {
    $this->time = $reps;
    return $this;
  }

}
