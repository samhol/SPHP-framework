<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views\Utils;

use Sphp\Html\AbstractContent;
use Sphp\Html\Text\Span;
use Sphp\Html\Media\Icons\FontAwesomeIcon;
use Sphp\Apps\Sports\Workouts\WeightLiftingExercise;
use Sphp\Apps\Sports\Workouts\BodyWeightExercise;
use Sphp\Apps\Sports\Workouts\TimedExercise;
use Sphp\Apps\Sports\Workouts\DistanceAndTimeExercise;
use Sphp\Apps\Sports\Workouts\Exercise;

/**
 * Class ExerciseIconView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExerciseIconView extends AbstractContent {

  /**
   * @var Exercise
   */
  private $exercise;
  private $exerciseTypeIconMap = [
      WeightLiftingExercise::class => 'fas fa-dumbbell',
      BodyWeightExercise::class => 'fas fa-male',
      TimedExercise::class => 'fas fa-clock',
      DistanceAndTimeExercise::class => 'fas fa-clock'
  ];
  private $exerciseNameIconMap = [
      'Skiing' => 'fas fa-skiing-nordic',
      'Tinbersports' => 'fas fa-dumbbell',
      'Basketball' => 'fas fa-basketball-ball',
      'Gardening' => 'fas fa-leaf',
      'Cycling' => 'fas fa-bicycle',
      'Swimming' => 'fas fa-swimmer',
      'Snow Plowing' => 'far fa-snowflake',
      'Running (Outdoor)' => 'fas fa-running',
      'Running (Indoor)' => 'fas fa-running',
  ];

  /**
   * Constructor
   * 
   * @param Exercise $exercise
   */
  public function __construct(Exercise $exercise) {
    $this->exercise = $exercise;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->exercise);
  }

  public function build(): Span {
    $span = new Span();
    $span->addCssClass('icon');
    $type = get_class($this->exercise);
    if (array_key_exists($this->exercise->getName(), $this->exerciseNameIconMap)) {
      $iconName = $this->exerciseNameIconMap[$this->exercise->getName()];
    } else if (array_key_exists($type, $this->exerciseTypeIconMap)) {
      $iconName = $this->exerciseTypeIconMap[$type];
    } else {
      $iconName = 'fas fa-heart';
    }
    $icon = new FontAwesomeIcon($iconName);
    $icon->fixedWidth(true);
    $span->append($icon);
    $name = $this->exercise->getName();
    if ($name === 'Skiing') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Walking') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Running (Outdoor)') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Swimming') {
      $span->addCssClass('outdoors water');
    } else if ($name === 'Cycling') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Tinbersports') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Gardening') {
      $span->addCssClass('outdoors');
    } else if ($name === 'Snow Plowing') {
      $span->addCssClass('outdoors winter');
    } else if ($name === 'Basketball') {
      $span->addCssClass('basketball');
    }
    return $span;
  }

  public function getHtml(): string {
    return $this->build()->getHtml();
  }

}
