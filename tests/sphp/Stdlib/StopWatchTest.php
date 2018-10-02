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
   */
  public function testStartAndStop() {
    $watch = new StopWatch();
    $this->assertSame($watch, $watch->start());
    usleep(200000);
    $this->assertGreaterThanOrEqual(.1, $watch->getTime());
  }

}
