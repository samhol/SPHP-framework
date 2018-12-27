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
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements pane builder for distance and time exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DistanceAndTimePaneBuilder extends TimedExercisePaneBuilder {

  public function totalsToHtml(Exercise $exercise): string {
    if (!$exercise instanceof DistanceAndTimeExercise) {
      throw new InvalidArgumentException('Excercise type must be ' . DistanceAndTimeExercise::class . ' (' . get_class($exercise) . ' given)');
    }
    $section = new PlainContainer();
    $list = new Ul();
    $list->append('<strong>distance:</strong> ' . $exercise->getTotalDistance() . '<span class="metric-unit">km</span>');
    $list->append('<strong>time:</strong> ' . $this->durationtoString($exercise->getTotalTime()));
    $list->append('<strong>average speed:</strong> ' . $exercise->getAverageSpeed() . '<span class="metric-unit">km/h</span>');
    $section->append($list);
    return "$section";
  }

}
