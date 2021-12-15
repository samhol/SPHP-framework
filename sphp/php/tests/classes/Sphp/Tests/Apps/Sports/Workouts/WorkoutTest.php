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
use Sphp\Apps\Sports\Workouts\Workout;
use Sphp\DateTime\ImmutableDate;

/**
 * Description of ExerciseLogTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class WorkoutTest extends TestCase {

  /**
   * @return Exercise
   */
  public function testConstructor(): Workout {
    $workout = new Workout(ImmutableDate::from('2018-11-1'));
    $this->assertTrue($workout->getDate()->dateEqualsTo(ImmutableDate::from('2018-11-1')));
    $this->assertTrue($workout->dateMatchesWith(ImmutableDate::from('2018-11-1')));
    $this->assertCount(0, $workout);
    return $workout;
  }

  /**
   * @depends testConstructor
   * @param Workout $workout
   */
  public function testInsertion(Workout $workout) {
    $exercise = $workout->distanceAndTimeExercise('Cycling', 'cardio');
    $this->assertTrue($workout->containsExercise($exercise));
    $this->assertSame('Cycling', $exercise->getName());
    $this->assertSame('cardio', $exercise->getDescription());
    $this->assertCount(1, $workout);
  }

}
