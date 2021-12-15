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

use Sphp\Apps\Sports\Workouts\Workout;
use Sphp\Apps\Sports\Workouts\WeightLiftingExercise;
use Sphp\Apps\Sports\Workouts\DistanceAndTimeExercise;
use Sphp\Apps\Sports\Workouts\BodyWeightExercise;
use Sphp\Apps\Sports\Workouts\TimedExercise;
use Sphp\Apps\Sports\Workouts\Exercise;
use Sphp\Html\Sections\Section;

/**
 * Implements a workout log viewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WorkoutLogView {

  /**
   * Builds a section containing the Workout
   * 
   * @param  Workout $workout
   * @return string the Workout view
   * @throws FitNotesException
   */
  public function build(Workout $workout): string {
    if ($workout->count() > 0) {
      $section = new Section();
      $section->addCssClass('group', 'workouts');
      $section->appendH2('Workouts <small>(' . $workout->count() . ' different exercises)</small>')->addCssClass('heading');

      foreach ($workout as $exercise) {
        $section->append($this->buildExerciseView($exercise));
      }
      return $section->getHtml();
    }
    return '';
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
