<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib;

use PHPUnit\Framework\TestCase;

class StopWatchTest extends TestCase {

  /**
   * @covers \Sphp\Stdlib\StopWatch::start
   * @covers \Sphp\Stdlib\StopWatch::getTime
   */
  public function testStartAndStop() {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->start());
    $this->assertGreaterThanOrEqual(0, $watch->getTime());
  }
  /**
   * @covers \Sphp\Stdlib\StopWatch::startFromRequest
   * @covers \Sphp\Stdlib\StopWatch::getTime
   */
  public function testStartFromRequest() {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->startFromRequest());
    $this->assertGreaterThanOrEqual(0, $watch->getTime());
  }

  /**
   * @covers \Sphp\Stdlib\StopWatch::getExecutionTime
   */
  public function testGetExecutionTime() {
    $this->assertGreaterThanOrEqual(0, StopWatch::getExecutionTime());
  }
}
