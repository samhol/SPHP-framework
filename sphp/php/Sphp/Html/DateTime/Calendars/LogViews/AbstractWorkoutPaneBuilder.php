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
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;
use Sphp\Html\Content;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;

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
   * @return Content exercise pane title content
   */
  abstract public function buildTitleContent(Exercise $exercise): Content;

  /**
   * Builds exercise pane content
   * 
   * @param  Exercise $exercise
   * @return Content exercise pane content
   */
  abstract public function buildContent(Exercise $exercise): Content;
}
