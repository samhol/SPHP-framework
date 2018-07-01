<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use DateInterval;
use Sphp\DateTime\Factory;

/**
 * Implements timed exercise set
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimedSet implements ExerciseSet {

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
    $item = [];
    if ($this->duration->h > 0) {
      $item[] = "{$this->duration->h} hours";
    }
    if ($this->duration->i > 0) {
      $item[] = "{$this->duration->i} minutes";
    }
    if ($this->duration->s > 0) {
      $item[] = "{$this->duration->s} seconds";
    }
    return implode(' ', $item);
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
      $duration = Factory::timeDiff($duration);
    }
    $this->duration = $duration;
    return $this;
  }

  /**
   * Returns the duration of the exercise set in hours
   * 
   * @return float the duration of the exercise set in hours
   */
  public function getHours(): float {
    return $this->duration->i / 60 + $this->duration->h;
  }

  /**
   * Returns the duration of the exercise set
   * 
   * @return float the duration of the exercise set in minutes
   */
  public function getMinutes(): float {
    return $this->duration->i + $this->duration->h * 60;
  }

}
