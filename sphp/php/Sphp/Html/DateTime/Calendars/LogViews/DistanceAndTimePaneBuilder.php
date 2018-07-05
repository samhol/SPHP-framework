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
use Sphp\Html\Tags;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\DistanceAndTimeExercise;
use Sphp\Html\Content;
use Sphp\Html\Container;
use Sphp\Html\ContainerInterface;

/**
 * Implements pane builder for distance and time exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DistanceAndTimePaneBuilder extends AbstractWorkoutPaneBuilder {

  public function buildContent(Exercise $exercise): ContainerInterface {
    $container = new Container();
    if ($exercise->count() === 1) {
      $list = new Ul();
    } else {
      $list = new Ol();
    }
    foreach ($exercise as $set) {
      $set->getAverageSpeed();
      $list->append($set);
    }
    $container->append($list);
    $container->append($exercise->getTotalDistance() . "km, at " . $exercise->getAverageSpeed() . "km/h");
    return $container;
  }

}
