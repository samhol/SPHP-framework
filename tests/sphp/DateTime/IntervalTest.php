<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Intervals;
use Sphp\DateTime\Interval;

class IntervalTest extends TestCase {

  public function testdateString() {
    $interval = Intervals::create('+2 days');
    $this->assertSame(2.0, $interval->toDays());
  }

  public function intervalStrings(): array {
    $strings[] = ['P1DT3S'];
    $strings[] = ['P1M'];
    $strings[] = ['PT3M'];
    $strings[] = ['P89D'];
    $strings[] = ['P1DT3S'];
    $strings[] = ['PT36S'];
    return $strings;
  }

  /**
   * @dataProvider intervalStrings
   */
  public function testToString(string $interval_spec) {
    $interval = new Interval($interval_spec);
    $this->assertSame($interval_spec, "$interval");
  }

}
