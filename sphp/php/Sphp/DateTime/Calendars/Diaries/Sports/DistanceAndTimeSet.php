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
  private $distance;

  /**
   * @var string
   */
  private $unit = 'km';

  /**
   * Constructor
   * 
   * @param float $distance
   * @param ImmutableDuration $duration the duration of the exercise set
   */
  public function __construct(float $distance, ImmutableDuration $duration) {
    parent::__construct($duration);
    $this->distance = $distance;
  }

  public function __toString(): string {
    $duration = parent::__toString();
    return sprintf("%skm in %s", $this->distance, $this->unit, $duration);
  }

  public function getDistance(): float {
    return $this->distance;
  }

  public function getAverageSpeed(): string {
    $hours = $this->getDuration()->getHours();
    return $this->distance / $hours;
  }

  public function toArray(): array {
    $arr = parent::toArray();
    return get_object_vars($this);
  }

}
