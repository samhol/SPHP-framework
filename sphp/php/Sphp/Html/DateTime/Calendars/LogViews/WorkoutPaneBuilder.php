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
use Sphp\Html\Foundation\Sites\Containers\Accordions\ContentPane;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;
use Sphp\DateTime\Calendars\Diaries\Sports\ExerciseSet;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;
use Sphp\Html\Tags;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Media\Icons\FaIcon;

/**
 * Abstract implementation of exercise pane builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WorkoutPaneBuilder {

  /**
   * Builds exercise pane
   * 
   * @param  Exercise $exercise
   * @return ContentPane exercise pane
   */
  public function buildPane(Exercise $exercise): ContentPane {
    $pane = new ContentPane();
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
    $title = new PlainContainer;
    $title[] = $this->descriptionToIcon($exercise);
    $title[] = Tags::span($exercise->getName());
    if ($exercise->getDescription() !== '') {
      $title->append(Tags::span(" ({$exercise->getDescription()})")->addCssClass('small'));
    }
    return $title;
  }

  public function descriptionToIcon(Exercise $exercise) {
    $span = Tags::span();
    $span->addCssClass('icon');
    if ($exercise instanceof WeightLiftingExercise) {
      $span->addCssClass('wr');
      $icon = new FaIcon('fas fa-dumbbell');
    } else if ($exercise->getName() === 'Skiing') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-skiing-nordic');
    } else if ($exercise->getName() === 'Walking') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-walking');
    } else if ($exercise->getName() === 'Running (Outdoor)') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-running');
    } else if ($exercise->getName() === 'Swimming') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-swimmer');
    } else if ($exercise->getName() === 'Cycling') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-bicycle');
    } else if ($exercise->getName() === 'Tinbersports') {
      $span->addCssClass('outdoors');
      $icon = new FaIcon('fas fa-tree');
    } else if ($exercise->getName() === 'Basketball') {
      $span->addCssClass('basketball');
      $icon = new FaIcon('fas fa-basketball-ball');
    } else {
      $icon = new FaIcon('fas fa-bolt');
    }
    $icon->fixedWidth(true);
    $span->append($icon);
    return $span;
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
    $container = Tags::section();
    if ($exercise->count() > 0) {
      if ($exercise instanceof WeightLiftingExercise || $exercise->count() > 1) {
        $container->appendH6('Sets:');
        $list = new Ol();
        foreach ($exercise as $set) {
          $list->append($this->setToHtml($set));
        }
        $container->append($list);
        $container->append('<hr>');
      }
      $container->appendH6('Totals:');
      $container->append($this->totalsToHtml($exercise));
    }
    return $container;
  }

}
