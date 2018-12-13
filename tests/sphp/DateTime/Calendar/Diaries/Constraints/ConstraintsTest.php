<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries\Constraints;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\Constraints\Weekly;
use Sphp\DateTime\Calendars\Diaries\Constraints\Monthly;
use Sphp\DateTime\Calendars\Diaries\Constraints\InRange;
use Sphp\DateTime\Calendars\Diaries\Constraints\Before;
use Sphp\DateTime\Calendars\Diaries\Constraints\After;
use Sphp\DateTime\Calendars\Diaries\Constraints\Annual;
use Sphp\DateTime\Calendars\Diaries\Constraints\VaryingAnnual;
use Sphp\DateTime\Calendars\Diaries\Constraints\OneOf;
use Sphp\DateTime\Calendars\Diaries\Constraints\Unique;
use Sphp\DateTime\Calendars\Diaries\Constraints\Constraints;

class ConstraintsTest extends TestCase {

  public function testWeekly() {
    $weekly = new Weekly(1, 5);
    $this->assertTrue($weekly->isValidDate('2018-10-1'));
    $this->assertFalse($weekly->isValidDate('2018-10-3'));
  }

  public function testMonthly() {
    $monthly = new Monthly(31);
    $this->assertFalse($monthly->isValidDate('2018-11-01'));
    $this->assertFalse($monthly->isValidDate('2018-02-31'));
    $this->assertFalse($monthly->isValidDate('2018-11-02'));
  }

  public function testInRange() {
    $range = new InRange('2018-1-1', '2018-1-5');
    $this->assertTrue($range->isValidDate('2018-1-1'));
    $this->assertTrue($range->isValidDate('2018-1-5'));
    $this->assertFalse($range->isValidDate('2018-02-31'));
    $this->assertFalse($range->isValidDate('2017-01-6'));
  }

  public function testBefore() {
    $before = new Before('2018-5-2');
    $this->assertTrue($before->isValidDate('2018-1-1'));
    $this->assertFalse($before->isValidDate('2018-11-02'));
  }

  public function testAfter() {
    $after = new After('2017-1-1');
    $this->assertTrue($after->isValidDate('2018-1-1'));
    $this->assertFalse($after->isValidDate('2016-11-02'));
  }

  public function testAnnual() {
    $annual = new Annual(5, 3);
    $this->assertTrue($annual->isValidDate('2018-5-3'));
    $this->assertFalse($annual->isValidDate('2018-12-02'));
  }

  public function testVaryingAnnual() {
    $varyingAnnual = new VaryingAnnual('%d-11-30 next Saturday');
    $this->assertTrue($varyingAnnual->isValidDate('2018-12-01'));
    $this->assertFalse($varyingAnnual->isValidDate('2018-12-02'));
  }

  public function testOneOf() {
    $oneof = new OneOf('2018-1-1', '2018-2-1');
    $this->assertSame($oneof, $oneof->addDates('2018-3-1', '2018-4-1'));
    $this->assertTrue($oneof->isValidDate('2018-3-1'));
    $this->assertFalse($oneof->isValidDate('2018-5-1'));
  }

  public function testUnique() {
    $oneof = new Unique('2018-1-1');
    $this->assertTrue($oneof->isValidDate('2018-1-1'));
    $this->assertFalse($oneof->isValidDate('2018-5-1'));
  }

  public function testConstraints() {
    $constraints = new Constraints();
    $this->assertSame($constraints, $constraints->dateIs(new Monthly(1)));
    $this->assertSame($constraints, $constraints->dateIs(new After('2018-9-5')));
    $this->assertSame($constraints, $constraints->dateIsNot(new Unique('2018-11-1')));
    $this->assertTrue($constraints->isValidDate('2018-10-1'));
    $this->assertFalse($constraints->isValidDate('2018-11-1'));
    $this->assertFalse($constraints->isValidDate('2018-9-1'));
  }

}
