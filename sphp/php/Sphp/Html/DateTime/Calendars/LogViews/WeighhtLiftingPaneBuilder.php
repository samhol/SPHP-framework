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
use Sphp\Html\Lists\Ol;
use Sphp\Html\Lists\StandardList;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\Html\ContainerInterface;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;

/**
 * Implements pane builder for weightlifting exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeighhtLiftingPaneBuilder extends AbstractWorkoutPaneBuilder {

  public function buildContent(Exercise $exercise): ContainerInterface {
    $container = parent::buildContent($exercise);
    if ($exercise instanceof WeightLiftingExercise) {
      $container->appendMd(<<<MD
 * **total weight:** `{$exercise->getTotalWeight()} kg`
 * **total reps:** `{$exercise->getTotalReps()}`
MD
      );
    }
    return $container;
  }

  public function buildSetList(Exercise $exercise): StandardList {
    if ($exercise->count() === 1) {
      $list = new Ul();
    } else {
      $list = new Ol();
    }
    foreach ($exercise as $set) {
      if ($set instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightliftingSet) {
        $setString = $set->getReps() . ' x ' . $set->getRepWeight() . " kg (total: {$set->getTotalWeight()}kg)";
        $list->append($setString);
      }
    }
    return $list;
  }

}
