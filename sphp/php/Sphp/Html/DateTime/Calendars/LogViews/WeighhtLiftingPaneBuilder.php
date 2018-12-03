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
use Sphp\Html\Flow\Section;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\ExerciseSet;

/**
 * Implements pane builder for weightlifting exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeighhtLiftingPaneBuilder extends AbstractWorkoutPaneBuilder {

  public function setToHtml(ExerciseSet $set): string {
    $output = '';
    if ($set instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightliftingSet) {
      $output .= $set->getReps() . ' &times; ' . $set->getRepWeight() . 'kg <span class="total">Total weight: ' . $set->getTotalWeight() . 'kg</span>';
    }
    return $output;
  }

  public function totalsToHtml(Exercise $exercise): string {
    $section = new Section();
    $section->appendH6('Totals:');
    $section->addCssClass('exercise-totals');
    $list = new Ul();
    $list->append('<strong>reps:</strong> ' . $exercise->getTotalReps());
    $list->append('<strong>weight:</strong> ' . $exercise->getTotalWeight() . '<span class="metric-unit">kg</span>');
    $section->append($list);
    return "$section";
  }

}
