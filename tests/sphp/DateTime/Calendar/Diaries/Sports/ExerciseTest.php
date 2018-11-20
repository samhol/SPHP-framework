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
use Sphp\DateTime\Calendars\Diaries\Sports\Exercise;

class ExerciseTest extends TestCase {

  /**
   * @return Exercise
   */
  public function testConstructor(): Exercise {
    $exercise = $this->getMockBuilder(Exercise::class)
            ->setConstructorArgs(['foo', 'bar'])
            ->enableOriginalConstructor()
            ->getMockForAbstractClass();
    $this->assertEquals('foo', $exercise->getName());
    $this->assertEquals('bar', $exercise->getDescription());
    return $exercise;
  }
  /**
   * @depends testConstructor
   * @param Exercise $exercise
   */
  public function testSets(Exercise $exercise) {
    $this->assertEquals('foo', $exercise->getName());
    $this->assertEquals('bar', $exercise->getDescription());
  }
}
