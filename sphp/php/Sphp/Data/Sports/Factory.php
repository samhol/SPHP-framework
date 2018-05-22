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
    $daily = new ExerciseDay($date);
    if ($data[3] !== '' && $data[4] !== '') {
      $daily->insert($e) new WeightLifting($date, $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
    } else if ($data[5] !== '' && $data[6] !== '' && $data[7] !== '') {
      $dist = (float) $data[5];
      if ($dist > 0) {
        $u = (string) $data[6];
        return new DistanceAndTimeExercise($date, $data[1], $data[2], (float) $data[5], $data[6], $data[7]);
      }
      return new DistanceAndTimeExercise($date, $data[1], $data[2], (float) $data[5], $data[6], $data[7]);
    }
  }


}
