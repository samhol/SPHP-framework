<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Lists\Ul;
use Sphp\Html\PlainContainer;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\ExerciseSet;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightliftingSet;

/**
 * Implements pane builder for weightlifting exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WeighhtLiftingPaneBuilder extends WorkoutPaneBuilder {

  public function setToHtml(ExerciseSet $set): string {
    $output = '';
    if ($set instanceof WeightliftingSet) {
      $output .= '<span class="metric-unit">' . $set->getReps() . ' &times; ' . $set->getRepWeight() . 'kg</span>, ';
      $output .= '<span class="total">total weight:</span> <span class="metric-unit">' . $set->getTotalWeight() . 'kg</span>';
    }
    return $output;
  }

  public function totalsToHtml(Exercise $exercise): string {
    $section = new PlainContainer();
    $list = new Ul();
    $list->append('<strong>reps:</strong> <span class="metric-unit">' . $exercise->getTotalReps() . '</span>');
    $list->append('<strong>weight:</strong> <span class="metric-unit">' . $exercise->getTotalWeight() . 'kg</span>');
    $section->append($list);
    return "$section";
  }

}
