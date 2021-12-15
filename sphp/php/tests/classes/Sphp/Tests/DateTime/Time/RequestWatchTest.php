<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Time;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Time\RequestWatch;

class RequestWatchTest extends TestCase {

  /**
   * @return void
   */
  public function testStartAndStop(): void {
    $start = microtime(true) - 2;
    $stub = $this->getMockBuilder(RequestWatch::class)
            ->setMethods(['getRequestStart'])
            ->getMock();
    $stub->expects($this->any())
            ->method('getRequestStart')
            ->will($this->returnValue($start));

    $this->assertGreaterThan(2, $stub->getTime());
  }

}
