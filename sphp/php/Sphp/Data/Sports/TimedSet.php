<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

use DateInterval;
use Sphp\DateTime\Factory;

/**
 * Implements anExercise with duration
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimedSet {

  /**
   * @var DateInterval
   */
  private $duration;

  /**
   * Constructor
   * 
   * @param DateInterval|string $duration the duration of the exercise set
   */
  public function __construct($duration) {
    $this->setDuration($duration);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->duration);
  }

  public function __toString(): string {
    $output = '';
    if ($this->duration->h > 0) {
      $output .= "{$this->duration->h} hours";
    }
    if ($this->duration->i > 0) {
      $output .= "{$this->duration->i} minutes";
    }
    if ($this->duration->s > 0) {
      $output .= "{$this->duration->s} seconds";
    }
    return $output;
  }

  /**
   * Returns the duration of the exercise set
   * 
   * @return DateInterval the duration of the exercise set
   */
  public function getDuration(): DateInterval {
    return $this->duration;
  }

  /**
   * Sets the duration of the exercise set
   * 
   * @param  DateInterval|string $duration the duration of the exercise set
   * @return $this for a fluent interface
   */
  public function setDuration($duration) {
    if (!$duration instanceof DateInterval) {
      echo "$duration";
      $duration = Factory::timeDiff($duration);
    }
    $this->duration = $duration;
    return $this;
  }

}
