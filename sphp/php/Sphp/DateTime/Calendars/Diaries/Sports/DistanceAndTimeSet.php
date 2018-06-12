<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

/**
 * Implements a distance and time set 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeSet extends TimedSet {

  /**
   * @var float
   */
  private $distance;

  /**
   * @var string
   */
  private $unit = 'm';

  /**
   * Constructor
   * 
   * @param float $distance
   * @param type $duration
   * @param string $unit
   */
  public function __construct(float $distance, $duration, string $unit = 'm') {
    parent::__construct($duration);
    $this->setDistance($distance, $unit);
  }

  public function __toString(): string {
    $duration = parent::__toString();
    return sprintf("%s%s in %s", $this->distance, $this->unit, $duration);
  }

  public function getDistance(string $unit = 'm'): float {
    if ($unit !== $this->unit) {

      $distance *= 1000;
    }
    return $this->distance;
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

}
