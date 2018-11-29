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
use Sphp\DateTime\ImmutableDuration;

/**
 * Description of DurationTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DurationTest extends TestCase {

  public function testdateString() {
    $interval = ImmutableDuration::from('1:00:00');
    $this->assertSame(1.0, $interval->toHours());
    $this->assertSame(60.0, $interval->toMinutes());
    $this->assertSame(3600.0, $interval->toSeconds());
  }

  public function intervalStrings(): array {
    $strings[] = ['PT86400S', 'P1D'];
    $strings[] = ['24:00:05', 'P1DT5S'];
    return $strings;
  }

  /**
   * @dataProvider intervalStrings
   */
  public function testToString(string $string, string $expected) {
    $interval = ImmutableDuration::from($string);
    $this->assertSame($expected, "$interval");
  }

  public function testAdding() {
    $d = new ImmutableDuration(0);
    $sum = $d->addSeconds(5);
    $this->assertEquals(5, $sum->toSeconds());
    $sun2 = $sum->addMinutes(5);
    $this->assertEquals(305, $sun2->toSeconds());
    $sun3 = $sun2->addHours(1);
    $this->assertEquals(3905, $sun3->toSeconds());
  }

  public function testOutputting() {
    $d = new ImmutableDuration();
    $this->assertEquals(30, $d->addHours(.5)->toMinutes());
    $this->assertEquals(.5, $d->addDays(.5)->toDays());
    $this->assertEquals(12, $d->addDays(.5)->toHours());
  }

  public function testComparing() {
    $d = new ImmutableDuration(5);
    $this->assertEquals(-1, $d->compareTo(10));
    $this->assertEquals(1, $d->compareTo(3));
  }

}
