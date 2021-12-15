<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\StopWatch;

class StopWatchTest extends TestCase {

  public function testStartAndStop(): void {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->start());
    $this->assertGreaterThanOrEqual(0, $watch->getTime());
  }

  public function testStartFromRequest(): void {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->startFromRequest());
    $this->assertGreaterThanOrEqual(0, $watch->getTime());
  }

  public function testGetExecutionTime(): void {
    $this->assertGreaterThanOrEqual(0, StopWatch::getExecutionTime());
  }

}
