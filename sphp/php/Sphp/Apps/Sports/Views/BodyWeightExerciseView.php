<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Views;

/**
 * Class BodyWeightExerciseView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyWeightExerciseView extends ExerciseView {

  public function totalsToArray(): array {
    $totals['total sets'] = $this->exercise->count();
    $totals['total reps'] = $this->exercise->getTotalReps();
    return $totals;
  }

  public function getFieldNames(): array {
    return ['reps'];
  }

}
