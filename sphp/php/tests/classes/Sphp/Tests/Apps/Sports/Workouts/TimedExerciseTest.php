<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Sports\Workouts;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Sports\Workouts\TimedExercise;
use Sphp\Apps\Sports\Workouts\TimedSet;
use Sphp\DateTime\Interval;

class TimedExerciseTest extends TestCase {

  /**
   * @return TimedExercise
   */
  public function testConstructor(): TimedExercise {
    $exercise = new TimedExercise('foo', 'bar');
    $this->assertEquals('foo', $exercise->getName());
    $this->assertEquals('bar', $exercise->getDescription());
    return $exercise;
  }

  public function sets(): array {
    $sets[] = ['duration' => 'P1DT1M'];
    $sets[] = ['duration' => 'PT1M'];
    $sets[] = ['duration' => 'P1DT1M'];
    $sets[] = ['duration' => 'P1DT1M'];
    return $sets;
  }

  /**
   * @depends testConstructor
   * @param WeightLiftingExercise $exercise
   */
  public function testAddSet(TimedExercise $exercise): TimedExercise {
    $setData = $this->sets();
    $totalDuration = new Interval();
    foreach ($setData as $setValues) {
      $duration = new Interval($setValues['duration']);
      $totalDuration = $totalDuration->add($duration);
      $set = $exercise->addSet($duration);
      $this->assertEquals($duration, $set->getDuration());
      // $this->assertEquals("{$weight}kg x $reps reps", "$set");
      $this->assertEquals(['duration' => \Sphp\Apps\Sports\Workouts\Utils::durationtoString($duration)], $set->toArray());
      $this->assertEquals($totalDuration, $exercise->getTotalDuration());
    }
    $this->assertCount(count($setData), $exercise);
    return $exercise;
  }

  /**
   * @depends testAddSet
   * @param TimedExercise $exercise
   */
  public function testTraversingSets(TimedExercise $exercise) {
    $length = 0;
    $totalTime = new Interval();
    foreach ($exercise as $set) {
      if (!$set instanceof TimedSet) {
        $this->fail('The Set is not  of' . TimedSet::class . '.');
      }
      //$this->assertInstanceof(TimedSet::class, $set);
      $totalTime = $totalTime->add($set->getDuration());
      $length++;
    }
    if ($length < $exercise->count()) {
      $this->fail('Invalid number of sets in the exercise');
    }
    $this->assertEquals($exercise->getTotalDuration()->toSeconds(), $totalTime->toSeconds());
  }

}
