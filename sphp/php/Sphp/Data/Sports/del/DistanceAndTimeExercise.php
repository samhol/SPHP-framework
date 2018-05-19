<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Sphp\DateTime\DateInterface;

/**
 * Description of DistanceAndTimeExercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DistanceAndTimeExercise extends Exercise {

  private $distance;
  private $unit;
  private $time;

  public function __construct(DateInterface $date, string $name, string $category, float $distance, $unit, $time) {
    parent::__construct($date, $name, $category);
  }

  public function getDistance(): float {
    return $this->distance;
  }

  public function getUnit() {
    return $this->unit;
  }

  public function getTime() {
    return $this->time;
  }

  public function setDistance($distance) {
    $this->distance = $distance;
    return $this;
  }

  public function setUnit($unit) {
    $this->unit = $unit;
    return $this;
  }

  public function setTime($time) {
    $this->time = $time;
    return $this;
  }

}
