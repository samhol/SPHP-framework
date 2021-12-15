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

/**
 * Implements pane builder for weightlifting exercises
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class WeightAndRepsExerciseView extends ExerciseView {

  public function getFieldNames(): array {
    return ['weight', 'reps', 'total weight'];
  }

  public function totalsToArray(): array {
    $list['total sets'] = count($this->exercise->getSets());
    $list['total reps'] = $this->exercise->getTotalReps();
    $list['total weight'] = $this->exercise->getTotalWeight() . 'kg';
    return $list;
  }

}
