<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Tags;
use Sphp\DateTime\Calendars\Diaries\Sports\DistanceAndTimeExercise;

/**
 * Description of WeighhtLiftingPaneBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DistanceAndTimePaneBuilder {

  public function buildPane(DistanceAndTimeExercise $exercise): Pane {
    $pane = new Pane($this->createPaneTitle($exercise));
    if ($exercise->count() === 1) {
      $list = new Ul();
    } else {
      $list = new Ol();
    }
    foreach ($exercise as $set) {
      $set->getAverageSpeed();
      $list->append($set);
    }
    $pane->append($list);
    return $pane;
  }

  public function createPaneTitle(DistanceAndTimeExercise $exercise): \Sphp\Html\Span {
    $title = Tags::span($exercise->getName());
    $title->append(Tags::strong(" ({$exercise->getDescription()})"));
    if ($exercise instanceof DistanceAndTimeExercise) {
      $title->append($exercise->getTotalDistance() . "km, " . $exercise->getAverageSpeed() . "km/h");
    }
    return $title;
  }

}
