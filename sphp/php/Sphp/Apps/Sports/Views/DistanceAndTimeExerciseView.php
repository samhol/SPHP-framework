<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views;

use Sphp\Apps\Sports\Workouts\Utils;

/**
 * Implements pane builder for distance and time exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DistanceAndTimeExerciseView extends TimedExerciseView {

  public function totalsToArray(): array {
    $totals['total distance'] = $this->exercise->getTotalDistance() . ' km';
    $totals['total duration'] = Utils::durationtoString($this->exercise->getTotalTime());
    $totals['average speed'] = $this->exercise->getAverageSpeed() . ' km/h';
    return $totals;
  }

  public function getFieldNames(): array {
    return ['distance', 'duration', 'average speed'];
  }

}
