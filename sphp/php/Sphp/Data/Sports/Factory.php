<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Data\Sports;

/**
 * Description of Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Factory {

  public static function fromFitnote(array $data): Exercise {
    $date = new \Sphp\DateTime\Date($data[0]);
    if ($data[3] !== '' && $data[4] !== '') {
      return new WeightAndReps($date, $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
    } else if ($data[5] !== '' && $data[6] !== '' && $data[7] !== '') {
      return new DistanceAndTimeExercise($date, $data[1], $data[2], (float) $data[5], $data[6], $data[7]);
    }
  }
  public static function fromFitnoteData(array $data): Exercise {
    
    $date = new \Sphp\DateTime\Date($data[0]);
    if ($data[3] !== '' && $data[4] !== '') {
      return new WeightAndReps($date, $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
    } else if ($data[5] !== '' && $data[6] !== '' && $data[7] !== '') {
      return new DistanceAndTimeExercise($date, $data[1], $data[2], (float) $data[5], $data[6], $data[7]);
    }
  }

}
