<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views;

use Sphp\DateTime\Duration;

/**
 * Implements pane builder for timed exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class TimedExerciseView extends ExerciseView {

  public function getFieldNames(): array {
    return ['duration'];
  }

  public function totalsToArray(): array {
    $tot['total duration'] = $this->durationtoString($this->exercise->getTotalDuration());
    return $tot;
  }

  public function durationtoString(Duration $duration): string {
    $item = [];
    if ($duration->h > 0) {
      $item[] = "{$duration->h} hrs";
    }
    if ($duration->i > 0) {
      $item[] = "{$duration->i} min";
    }
    if ($duration->s > 0) {
      $item[] = "{$duration->s} sec";
    }
    return \implode(' ', $item);
  }

}
