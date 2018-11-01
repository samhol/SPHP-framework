<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews;

use Sphp\Html\Lists\Dl;
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;

/**
 * Implements pane builder for weightlifting exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class WeighhtLiftingPaneBuilder extends AbstractWorkoutPaneBuilder {

  public function totalsToHtml(Exercise $exercise): string {
    $del = new Dl;
    $del->appendTerm('Totals:')->addCssClass('strong');
    $del->appendDescription('<strong>reps:</strong> ' . $exercise->getTotalReps() . ',<strong>weight:</strong> ' . $exercise->getTotalWeight() . ' kg');
    return "$del";
  }

}
