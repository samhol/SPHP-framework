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
 * Implements timed exercise set
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TimedSet implements ExerciseSet {

  /**
   * @var ImmutableDuration
   */
  private $duration;

  /**
   * Constructor
   * 
   * @param ImmutableDuration $duration the duration of the exercise set
   */
  public function __construct(ImmutableDuration $duration) {
    $this->duration = $duration;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->duration);
  }

  public function __toString(): string {
    $interval = $this->getDuration()->toInterval();
    $item = [];
    if ($interval->h > 0) {
      $item[] = "{$interval->h} hours";
    }
    if ($interval->i > 0) {
      $item[] = "{$interval->i} minutes";
    }
    if ($interval->s > 0) {
      $item[] = "{$interval->s} seconds";
    }
    return \implode(' ', $item);
  }

  /**
   * Returns the duration of the exercise set
   * 
   * @return ImmutableDuration the duration of the exercise set
   */
  public function getDuration(): ImmutableDuration {
    return $this->duration;
  }

  public function toArray(): array {
    return ['duration' => "$this->duration"];
  }

}
