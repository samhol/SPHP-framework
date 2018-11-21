<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries\Sports;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise;

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

  /**
   * @depends testConstructor
   * @param WeightLiftingExercise $exercise
   */
  public function testSets(WeightLiftingExercise $exercise): WeightLiftingExercise {
    $exercise->addSet(10, 5);
    $this->assertCount(1, $exercise);
    $this->assertEquals(5, $exercise->getTotalReps());
    $this->assertEquals(50, $exercise->getTotalWeight());
    return $exercise;
  }

  /**
   * @depends testSets
   * @param WeightLiftingExercise $exercise
   */
  public function testAddSets(WeightLiftingExercise $exercise): WeightLiftingExercise {
    $set = $exercise->addSet(2.5, 2);
    $this->assertEquals(2.5, $set->getRepWeight());
    $this->assertEquals("2.5kg x 2 reps", "$set");
    $this->assertCount(2, $exercise);
    $this->assertEquals(7, $exercise->getTotalReps());
    $this->assertEquals(55, $exercise->getTotalWeight());
    return $exercise;
  }

}
