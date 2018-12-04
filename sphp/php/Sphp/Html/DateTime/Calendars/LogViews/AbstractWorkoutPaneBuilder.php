<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Container;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Pane;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\ExerciseSet;
use Sphp\Html\Tags;
use Sphp\Html\Flow\Section;
use Sphp\Html\Lists\Ol;

/**
 * Abstract implementation of exercise pane builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractWorkoutPaneBuilder {

  /**
   * Builds exercise pane
   * 
   * @param  Exercise $exercise
   * @return Pane exercise pane
   */
  public function buildPane(Exercise $exercise): Pane {
    $pane = new Pane();
    $pane->setPaneTitle($this->buildTitleContent($exercise));
    $pane->append($this->buildContent($exercise));
    return $pane;
  }

  /**
   * Builds exercise pane title content
   * 
   * @param  Exercise $exercise
   * @return Container exercise pane title content
   */
  public function buildTitleContent(Exercise $exercise): Container {
    $title = Tags::span($exercise->getName());
    if ($exercise->getDescription() !== '') {
      $title->append(Tags::small(" ({$exercise->getDescription()})"));
    }
    return $title;
  }

  public function setToHtml(ExerciseSet $set): string {
    return "$set";
  }

  public function totalsToHtml(Exercise $exercise): string {
    return "$exercise";
  }

  /**
   * Builds exercise pane content
   * 
   * @param  Exercise $exercise
   * @return Container exercise pane content
   */
  public function buildContent(Exercise $exercise): Container {
    $container = new Section();
    if ($exercise->count() > 0) {
      if ($exercise instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
        $container->appendH6('Sets:');
        $list = new Ol();
        foreach ($exercise as $set) {
          $list->append($this->setToHtml($set));
        }
        $container->append($list);
      }
      $container->append('<hr>');
      $container->append($this->totalsToHtml($exercise));
    }
    return $container;
  }

}
