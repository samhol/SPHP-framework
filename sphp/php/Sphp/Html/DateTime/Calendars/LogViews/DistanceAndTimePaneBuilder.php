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
use Sphp\DateTime\Calendars\Diaries\Sports\DistanceAndTimeExercise;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;
use Sphp\DateTime\Duration;

/**
 * Implements pane builder for distance and time exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DistanceAndTimePaneBuilder extends WorkoutPaneBuilder {

  public function totalsToHtml(Exercise $exercise): string {
    if (!$exercise instanceof DistanceAndTimeExercise) {
      throw new \Sphp\Exceptions\InvalidArgumentException;
    }
    $section = new PlainContainer();
    $list = new Ul();
    $list->append('<strong>distance:</strong> ' . $exercise->getTotalDistance() . 'km');
    $list->append('<strong>time:</strong> ' . $this->durationtoString($exercise->getTotalTime()) . '<span class="metric-unit"></span>');
    $list->append('<strong>average speed:</strong> ' . $exercise->getAverageSpeed() . '<span class="metric-unit">km/h</span>');
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
