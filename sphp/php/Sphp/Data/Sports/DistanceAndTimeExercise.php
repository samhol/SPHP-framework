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

  private $sets = [];

  public function __construct(string $name, string $category) {
    parent::__construct($name, $category);
  }

  public function __toString() {
    $output = parent::__toString();
    foreach ($this->sets as $set) {
      $output .= "\n\t\t$set";
    }
    return $output;
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

  public function addSet($distance, $unit, $time) {
    $this->sets[] =new DistanceAndTimeSet($distance, $time, $unit);
  }

}
