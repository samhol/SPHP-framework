<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Constraints;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Constraints\Weekly;
use Sphp\DateTime\Constraints\Monthly;
use Sphp\DateTime\Constraints\Between;
use Sphp\DateTime\Constraints\Before;
use Sphp\DateTime\Constraints\After;
use Sphp\DateTime\Constraints\Annual;
use Sphp\DateTime\Constraints\VaryingAnnual;
use Sphp\DateTime\Constraints\OneOf;
use Sphp\DateTime\Constraints\Unique;
use Sphp\DateTime\Constraints\Constraints;

class ConstraintsTest extends TestCase {

  public function testWeekly() {
    $weekly = new Weekly(1, 5);
    $this->assertTrue($weekly->isValid('2018-10-1'));
    $this->assertFalse($weekly->isValid('2018-10-3'));
  }

  public function testMonthly() {
    $monthly = new Monthly(31);
    $this->assertFalse($monthly->isValid('2018-11-01'));
    $this->assertFalse($monthly->isValid('2018-02-31'));
    $this->assertFalse($monthly->isValid('2018-11-02'));
  }

  public function testBetween() {
    $range = new Between('2018-1-1', '2018-1-5');
    $this->assertTrue($range->isValid('2018-1-1'));
    $this->assertTrue($range->isValid('2018-1-5'));
    $this->assertFalse($range->isValid('2018-02-31'));
    $this->assertFalse($range->isValid('2017-01-6'));
  }

  public function testBefore() {
    $before = new Before('2018-5-2');
    $this->assertTrue($before->isValid('2018-1-1'));
    $this->assertFalse($before->isValid('2018-11-02'));
  }

  public function testAfter() {
    $after = new After('2017-1-1');
    $this->assertTrue($after->isValid('2018-1-1'));
    $this->assertFalse($after->isValid('2016-11-02'));
  }

  public function testAnnual() {
    $annual = new Annual(5, 3);
    $this->assertTrue($annual->isValid('2018-5-3'));
    $this->assertFalse($annual->isValid('2018-12-02'));
  }

  public function testVaryingAnnual() {
    $varyingAnnual = new VaryingAnnual('%d-11-30 next Saturday');
    $this->assertTrue($varyingAnnual->isValid('2018-12-01'));
    $this->assertFalse($varyingAnnual->isValid('2018-12-02'));
  }

  public function testOneOf() {
    $oneof = new OneOf('2018-1-1', '2018-2-1');
    $this->assertSame($oneof, $oneof->addDates('2018-3-1', '2018-4-1'));
    $this->assertTrue($oneof->isValid('2018-3-1'));
    $this->assertFalse($oneof->isValid('2018-5-1'));
  }

  public function testUnique() {
    $oneof = new Unique('2018-1-1');
    $this->assertTrue($oneof->isValid('2018-1-1'));
    $this->assertFalse($oneof->isValid('2018-5-1'));
  }

  public function testConstraints() {
    $constraints = new Constraints();
    $this->assertSame($constraints, $constraints->dateIs(new Monthly(1)));
    $this->assertSame($constraints, $constraints->dateIs(new After('2018-9-5')));
    $this->assertSame($constraints, $constraints->dateIsNot(new Unique('2018-11-1')));
    $this->assertTrue($constraints->isValid('2018-10-1'));
    $this->assertFalse($constraints->isValid('2018-11-1'));
    $this->assertFalse($constraints->isValid('2018-9-1'));
  }

}
