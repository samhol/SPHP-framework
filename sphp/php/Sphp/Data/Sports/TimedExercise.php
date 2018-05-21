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
 * Description of TimedExercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimedExercise {

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

  public function getTime() {
    return $this->time;
  }

  public function setTime($time) {

    $ed['time'] = $exersice[7];
    $rawTime = $exersice[7];
    $parts = explode(':', $rawTime);
    $dateint = 'PT' . $parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . "S";
    echo "$dateint\n";

    $interval = new \DateInterval($dateint);
    echo $interval->format('%h hours');
    $this->time = $time;
    return $this;
  }

  public function addSet($time) {
    $this->sets[] = new DistanceAndTimeSet($distance, $time, $unit);
  }

}
