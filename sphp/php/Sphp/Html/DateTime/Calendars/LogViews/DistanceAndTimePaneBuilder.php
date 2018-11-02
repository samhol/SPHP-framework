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
 * Implements pane builder for distance and time exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DistanceAndTimePaneBuilder extends AbstractWorkoutPaneBuilder {

  public function totalsToHtml(Exercise $exercise): string {
    $container = new Dl;
    $container->appendTerm('Totals:')->addCssClass('strong');
    $container->appendDescription("<strong>Distance:</strong>" . $exercise->getTotalDistance() . "km, <strong>average speed:</strong> " . $exercise->getAverageSpeed() . "km/h");
    return "$container";
  }

}
