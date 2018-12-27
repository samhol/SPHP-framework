<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\TimedExercise;
use Sphp\Html\Flow\Section;
use Sphp\DateTime\Duration;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements pane builder for timed exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class TimedExercisePaneBuilder extends WorkoutPaneBuilder {

  public function totalsToHtml(Exercise $exercise): string {
    if (!$exercise instanceof TimedExercise) {
      throw new InvalidArgumentException('Excercise type must be ' . TimedExercise::class . ' (' . get_class($exercise) . ' given)');
    }
    $section = new Section();
    $section->appendH6('Total time: <small>' . $this->durationtoString($exercise->getTotalTime()) . '</small>');
    return "$section";
  }

  public function durationtoString(Duration $duration): string {
    $interval = $duration->toInterval();
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

}
