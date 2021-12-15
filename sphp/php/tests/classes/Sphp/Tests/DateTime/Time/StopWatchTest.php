<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Time;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Time\StopWatch;
use Sphp\DateTime\Exceptions\InvalidStateException;

class StopWatchTest extends TestCase {

  /**
   * @return void
   */
  public function testStartAndContinueAndStop(): void {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->start());
    $t1 = $watch->getNanoSeconds();
    $this->assertGreaterThanOrEqual(0, $t1);
    $this->assertGreaterThanOrEqual($t1, $t2 = $watch->getNanoSeconds());
    $this->assertSame($watch, $watch->stop());
    $t3 = $watch->getNanoSeconds();
    $this->assertGreaterThanOrEqual(0, $t1);
    $this->assertGreaterThanOrEqual($t2, $t3);
    $this->assertSame($watch, $watch->contínue());
    $t4 = $watch->getNanoSeconds();
    $this->assertGreaterThanOrEqual($t3, $t4);
  }

  /**
   * @return void
   */
  public function testContinueFailure(): void {
    $watch = new StopWatch();
    $this->expectException(InvalidStateException::class);
    $watch->contínue();
  }

  /**
   * @return void
   */
  public function testStopFailure(): void {
    $watch = new StopWatch();
    $this->expectException(InvalidStateException::class);
    $watch->stop();
  }

  /**
   * @return void
   */
  public function testGetNanoSecondsFailures(): void {
    $watch = new StopWatch();
    $this->expectException(InvalidStateException::class);
    $watch->getNanoSeconds();
  }

  /**
   * @return void
   */
  public function testGetMilliSecondsFailures(): void {
    $watch = new StopWatch();
    $this->expectException(InvalidStateException::class);
    $watch->getMilliSeconds();
  }

  /**
   * @return void
   */
  public function testGetSecondsFailures(): void {
    $watch = new StopWatch();
    $this->expectException(InvalidStateException::class);
    $watch->getSeconds();
  }

}
