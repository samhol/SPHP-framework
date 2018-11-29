<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\DateTime\Interval;
use Sphp\DateTime\Duration;

/**
 * Implements timed exercise set
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimedSet implements ExerciseSet {

  /**
   * @var Duration
   */
  private $duration;

  /**
   * Constructor
   * 
   * @param Duration $duration the duration of the exercise set
   */
  public function __construct(Duration $duration) {
    $this->duration = $duration;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->duration);
  }

  public function __toString(): string {
    $item = [];
    if ($this->duration->toHours() > 0) {
      $item[] = "{$this->duration->getFullHours()} hours";
    }
    if ($this->duration->toMinutes() > 0) {
      $item[] = "{$this->duration->toMinutes()} minutes";
    }
    if ($this->duration->toSeconds() > 0) {
      $item[] = "{$this->duration->toSeconds()} seconds";
    }
    return \implode(' ', $item);
  }

  /**
   * Returns the duration of the exercise set
   * 
   * @return Duration the duration of the exercise set
   */
  public function getDuration(): Duration {
    return $this->duration;
  }

  public function toArray(): array {
    return ['duration' => "$this->duration"];
  }

}
