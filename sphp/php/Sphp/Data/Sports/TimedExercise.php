<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use Sphp\DateTime\Factory;

/**
 * Description of TimedExercise
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimedExercise extends Exercise {

  private $sets = [];

  public function __construct(string $name, string $category) {
    parent::__construct($name, $category);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->sets);
    parent::__destruct();
  }

  public function __toString(): string {
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
    $interval = Factory::timeDiff($time);
    $this->time = $interval;
    return $this;
  }

  public function addSet($time) {
    $this->sets[] = new TimedSet($time);
  }

}
