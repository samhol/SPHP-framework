<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\Logs;

class LogsTest extends TestCase {

  public function testWeekly() {
    $weekly = Logs::weekly([1], 'foo');
    $this->assertTrue($weekly->dateMatchesWith('2018-10-1'));
    $this->assertFalse($weekly->dateMatchesWith('2018-10-3'));
  }

  public function testMonthly() {
    $monthly = Logs::monthly(31, 'foo');
    $this->assertFalse($monthly->dateMatchesWith('2018-11-01'));
    $this->assertFalse($monthly->dateMatchesWith('2018-02-31'));
    $this->assertFalse($monthly->dateMatchesWith('2018-11-02'));
  }

  public function testBetween() {
    $range = Logs::between('2018-1-1', '2018-1-5', 'foo');
    $this->assertTrue($range->dateMatchesWith('2018-1-1'));
    $this->assertTrue($range->dateMatchesWith('2018-1-4'));
    $this->assertFalse($range->dateMatchesWith('2017-12-31'));
    $this->assertFalse($range->dateMatchesWith('2017-01-6'));
  }

  public function testBefore() {
    $before = Logs::before('2018-5-2', 'foo');
    $this->assertTrue($before->dateMatchesWith('2018-1-1'));
    $this->assertFalse($before->dateMatchesWith('2018-11-02'));
  }

  public function testAfter() {
    $after = Logs::after('2017-1-1', 'foo');
    $this->assertTrue($after->dateMatchesWith('2018-1-1'));
    $this->assertFalse($after->dateMatchesWith('2016-11-02'));
  }

  public function testAnnual() {
    $annual = Logs::annual(5, 3, 'foo');
    $this->assertTrue($annual->dateMatchesWith('2018-5-3'));
    $this->assertFalse($annual->dateMatchesWith('2018-12-02'));
  }

  public function testVaryingAnnual() {
    $log = Logs::varyingAnnual('%d-11-30 next Saturday', 'foo');
    $this->assertTrue($log->dateMatchesWith('2018-12-01'));
    $this->assertFalse($log->dateMatchesWith('2018-12-02'));
  }

  public function testOneOf() {
    $log = Logs::oneOf(['2018-1-1', '2018-2-1'], 'foo');
    $this->assertTrue($log->dateMatchesWith('2018-1-1'));
    $this->assertFalse($log->dateMatchesWith('2018-5-1'));
  }

  public function testUnique() {
    $log = Logs::unique('2018-1-1', 'foo');
    $this->assertTrue($log->dateMatchesWith('2018-1-1'));
    $this->assertFalse($log->dateMatchesWith('2018-5-1'));
  }


}
