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
use Sphp\DateTime\Duration;
use Sphp\DateTime\Interval;

/**
 * Description of DurationTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DurationTest extends TestCase{
  
  public function testdateString() {
    $interval = Duration::fromString('1:00:00');
    $this->assertSame(1.0, $interval->toHours());
    $this->assertSame(60.0, $interval->toMinutes());
    $this->assertSame(3600.0, $interval->toSeconds());
  }

  public function intervalStrings(): array {
    $strings[] = ['P0Y0M2DT1H22M1S', 'P2DT1H22M1S'];
    $strings[] = ['P0Y1M0DT0H0M0S', 'P1M'];
    $strings[] = ['P0Y0M0DT0H3M0S', 'PT3M'];
    return $strings;
  }

  /**
   * @dataProvider intervalStrings
   */
  public function testToString(string $interval_spec, string $expected) {
    $interval = new Duration($interval_spec);
    $this->assertSame($expected, "$interval");
  }

  public function testArithmetics() {
    $interval = new Interval('P1DT1H');
    $sum = $interval->add(new Interval('P1M1DT2H3M'));
    $this->assertSame('P1M2DT3H3M', "$sum");
    $div = $interval->add(new Interval('-P1M1DT2H3M'));
    $this->assertSame('P1DT1H', "$div");
    
  }
}
