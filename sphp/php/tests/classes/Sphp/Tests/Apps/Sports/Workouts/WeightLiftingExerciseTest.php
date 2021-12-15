<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Sports\Workouts;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Sports\Workouts\WeightLiftingExercise;

class WeightLiftingExerciseTest extends TestCase {

  /**
   * @return WeightLiftingExercise
   */
  public function testConstructor(): WeightLiftingExercise {
    $exercise = new WeightLiftingExercise('foo', 'bar');
    $this->assertEquals('foo', $exercise->getName());
    $this->assertEquals('bar', $exercise->getDescription());
    $this->assertEquals(0, $exercise->getTotalReps());
    $this->assertEquals(0, $exercise->getTotalWeight());
    return $exercise;
  }

  public function sets(): array {
    $sets[] = ['weight' => 10, 'reps' => 5];
    $sets[] = ['weight' => 12, 'reps' => 15];
    $sets[] = ['weight' => 10, 'reps' => 0];
    $sets[] = ['weight' => 10, 'reps' => 5];
    return $sets;
  }

  /**
   * @depends testConstructor
   * @param WeightLiftingExercise $exercise
   */
  public function testAddSet(WeightLiftingExercise $exercise): WeightLiftingExercise {
    $setData = $this->sets();
    $totalWeight = 0;
    $totalReps = 0;
    foreach ($setData as $setValues) {
      $weight = $setValues['weight'];
      $reps = $setValues['reps'];
      $totalRepWight = $weight * $reps;
      $totalWeight += $weight * $reps;
      $totalReps += $reps;
      $set = $exercise->addSet($weight, $reps);
      $this->assertEquals($weight, $set->getRepWeight());
      $this->assertEquals($weight, $set->getRepWeight());
      $this->assertEquals($reps, $set->getReps());
      $this->assertEquals($totalRepWight, $set->getTotalWeight());
     // $this->assertEquals($setValues, $set->toArray());
      $this->assertEquals($totalWeight, $exercise->getTotalWeight());
      $this->assertEquals($totalReps, $exercise->getTotalReps());
    }
    $this->assertCount(count($setData), $exercise);
    return $exercise;
  }

}
