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

/**
 * Description of DurationTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DurationTest extends TestCase {

  public function testdateString() {
    $interval = Duration::from('1:00:00');
    $this->assertSame(1.0, $interval->toHours());
    $this->assertSame(60.0, $interval->toMinutes());
    $this->assertSame(3600.0, $interval->toSeconds());
  }

  public function intervalStrings(): array {
    $strings[] = ['P1D', 'PT86400S'];
    return $strings;
  }

  /**
   * @dataProvider intervalStrings
   */
  public function testToString(string $string, string $expected) {
    $interval = Duration::from($string);
    $this->assertSame($expected, "$interval");
  }

  public function testAdding() {
    $d = new Duration(0);
    $d->addSeconds(5);
    $this->assertEquals(5, $d->toSeconds());
    $d->addMinutes(5);
    $this->assertEquals(305, $d->toSeconds());
    $d->addHours(1);
    $this->assertEquals(3905, $d->toSeconds());
  }

  public function testOutputting() {
    $d = new Duration(0);
    $d->addHours(.5);
    $this->assertEquals(30, $d->toMinutes());
    $this->assertEquals(30 * 60, $d->toSeconds());
    $d = new Duration(0);
    $d->addDays(.5);
    $this->assertEquals(.5, $d->toDays());
    $this->assertEquals(12, $d->toHours());
  }

  public function testComparing() {
    $d = new Duration(5);
    $this->assertEquals(-1,  $d->compareTo('00:12:00'));
  }
}
