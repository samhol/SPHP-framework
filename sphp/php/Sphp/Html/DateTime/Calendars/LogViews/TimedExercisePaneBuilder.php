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
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;
use Sphp\DateTime\Duration;
/**
 * Implements pane builder for timed exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimedExercisePaneBuilder extends WorkoutPaneBuilder {
  
  public function totalsToHtml(Exercise $exercise): string {
    if (!$exercise instanceof TimedExercise) {
      throw new \Sphp\Exceptions\InvalidArgumentException;
    }
    $section = new PlainContainer();
    $list = new Ul();
    $list->append('<strong>time:</strong> ' . $this->durationtoString($exercise->getTotalTime()) . '<span class="metric-unit"></span>');
    $section->append($list);
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
