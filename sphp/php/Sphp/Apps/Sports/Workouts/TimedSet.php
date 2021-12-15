<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;
use Sphp\DateTime\Duration;
use Sphp\Apps\Sports\Workouts\Utils;

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
  private Duration $duration;

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

  /**
   * Returns the duration of the exercise set
   * 
   * @return Duration the duration of the exercise set
   */
  public function getDuration(): Duration {
    return $this->duration;
  }

  public function toArray(): array {
    $arr = [];
    $arr['duration'] = Utils::durationtoString($this->getDuration());
    return $arr;
  }

}
