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

  public function __toString(): string {
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

  public function addSet(float $distance, $duration, string $unit = 'km') {
    $this->sets[] = new DistanceAndTimeSet($distance, $duration, $unit);
  }

}
