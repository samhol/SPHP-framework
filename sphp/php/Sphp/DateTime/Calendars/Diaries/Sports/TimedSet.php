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
use Sphp\DateTime\Intervals;

/**
 * Implements timed exercise set
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimedSet implements ExerciseSet {

  /**
   * @var Interval
   */
  private $duration;

  /**
   * Constructor
   * 
   * @param Interval|string $duration the duration of the exercise set
   */
  public function __construct($duration) {
    if (!$duration instanceof Interval) {
      $duration = Intervals::create($duration);
    }
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
    if ($this->duration->h > 0) {
      $item[] = "{$this->duration->h} hours";
    }
    if ($this->duration->i > 0) {
      $item[] = "{$this->duration->i} minutes";
    }
    if ($this->duration->s > 0) {
      $item[] = "{$this->duration->s} seconds";
    }
    return \implode(' ', $item);
  }

  /**
   * Returns the duration of the exercise set
   * 
   * @return Interval the duration of the exercise set
   */
  public function getDuration(): Interval {
    return $this->duration;
  }

  public function toArray(): array {
    return ['duration' => "$this->duration"];
  }

}
