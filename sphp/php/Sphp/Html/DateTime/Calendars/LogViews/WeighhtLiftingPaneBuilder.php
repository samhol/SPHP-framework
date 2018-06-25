<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Ol;
use Sphp\Html\TagFactory;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;

/**
 * Description of WeighhtLiftingPaneBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeighhtLiftingPaneBuilder {

  public function buildPane(WeightLiftingExercise $exercise): Pane {
    $pane = new Pane($this->createPaneTitle($exercise));
    if ($exercise->count() === 1) {
      $list = new Ul();
    } else {
      $list = new Ol();
    }
    foreach ($exercise as $set) {
      $list->append($set);
    }
    $pane->append($list);
    return $pane;
  }

  public function createPaneTitle(WeightLiftingExercise $exercise): \Sphp\Html\Span {
    $title = TagFactory::span($exercise->getName());
    $title->append(TagFactory::strong(" ({$exercise->getDescription()})"));
    if ($exercise instanceof WeightLiftingExercise) {
      $title->append($exercise->getTotalWeight());
    }
    return $title;
  }

}
