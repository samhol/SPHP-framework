<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views\Main;

use Sphp\Apps\Sports\Workouts\Workout;
use Sphp\Apps\Sports\Workouts\WeightLiftingExercise;
use Sphp\Apps\Sports\Workouts\DistanceAndTimeExercise;
use Sphp\Apps\Sports\Workouts\BodyWeightExercise;
use Sphp\Apps\Sports\Workouts\TimedExercise;
use Sphp\Apps\Sports\Workouts\Exercise;
use Sphp\Html\Sections\Section;
use Sphp\Apps\Sports\Views\WeightAndRepsExerciseView;
use Sphp\Apps\Sports\Views\ExerciseView;
use Sphp\Apps\Sports\Views\DistanceAndTimeExerciseView;
use Sphp\Apps\Sports\Views\TimedExerciseView;
use Sphp\Apps\Sports\Views\BodyWeightExerciseView;
use Sphp\Bootstrap\Components\Accordions\Accordion;
use Sphp\Apps\Sports\Views\Utils\ExerciseViews;

/**
 * The DailyActivity class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DailyActivity {

  /**
   * Builds a section containing the Workout
   * 
   * @param  Workout $workout
   * @return string the Workout view
   * @throws FitNotesException
   */
  public function build(Workout $workout): string {
    $section = new Section();
    $section->addCssClass('group', 'workouts');
    $date = $workout->getDate();
    $h3 = $section->appendH3($date->format('l, jS \of F Y') . ' ');
    $h3->addCssClass('date-heading', 'px-2', 'py-3');
    if ($workout->count() > 0) {
      $h3->appendSmall($workout->count() . ' exercises');
      $workoutViews = new \Sphp\Apps\Sports\Views\Utils\WorkoutViews($workout);
      $section->append($workoutViews->buidExerciseAccordion());
    } else {
      $section->appendParagraph('No exercises this day!');
    }
    return $section->getHtml();
  }

  protected function buidExerciseAccordion(Workout $workout) {
    $accordion = new Accordion();
    foreach ($workout as $exercise) {
      $builder = new ExerciseViews($exercise);
      $t = $builder->build();
      $accordion->appendPane($builder->buildTitleContent(), $t);
    }
    $workoutViews = new \Sphp\Apps\Sports\Views\Utils\WorkoutViews($workout);
    return $workoutViews->buidExerciseAccordion();
  }

  /**
   * Builds an exercise view
   * 
   * @param  Exercise $exercise
   * @return ExerciseView the exercise view
   * @throws FitNotesException
   */
  public function buildExerciseView(Exercise $exercise): ExerciseView {
    if ($exercise instanceof WeightLiftingExercise) {
      $view = new WeightAndRepsExerciseView($exercise);
    } else if ($exercise instanceof DistanceAndTimeExercise) {
      $view = new DistanceAndTimeExerciseView($exercise);
    } else if ($exercise instanceof TimedExercise) {
      $view = new TimedExerciseView($exercise);
    } else if ($exercise instanceof BodyWeightExercise) {
      $view = new BodyWeightExerciseView($exercise);
    } else {
      throw new FitNotesException('Unknown Exercise type');
    }
    return $view;
  }

}
