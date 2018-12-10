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
use Sphp\DateTime\Calendars\Diaries\Sports\Workouts;

/**
 * Description of ExerciseLogTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ExerciseLogTest extends TestCase {

  public function dates(): array {
    $dates[] = ['2018-11-1'];
    return $dates;
  }

  /**
   * @return Exercise
   */
  public function testConstructor(): Workouts {
    $workouts = new Workouts('2018-11-1');
    $this->assertTrue($workouts->getDate()->dateEqualsTo('2018-11-1'));
    $this->assertTrue($workouts->dateMatchesWith('2018-11-1'));
    $this->assertCount(0, $workouts);
    return $workouts;
  }

  /**
   * @depends testConstructor
   * @param Workouts $workouts
   */
  public function testInsertion(Workouts $workouts) {
    $exercise = $workouts->distanceAndTimeExercise('Cycling', 'cardio');
    $this->assertSame($exercise, $workouts->getExercise('Cycling'));
    $this->assertSame('Cycling', $exercise->getName());
    $this->assertSame('cardio', $exercise->getDescription());
    $this->assertCount(1, $workouts);
  }

}
