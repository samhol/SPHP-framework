<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Constraints;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Constraints\{
  Weekdays,
  Monthly,
  Between,
  Before,
  After,
  Annual,
  VaryingAnnual,
  AnyOfDates,
  InPeriod,
  Constraints,
  Factory
};
use Sphp\DateTime\Period;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Exceptions\{
  BadMethodCallException,
  InvalidArgumentException
};

class ConstraintsTest extends TestCase {

  public function testWeekly(): void {
    $weekly = new Weekdays(1, 5);
    $this->assertTrue($weekly->isValid(ImmutableDate::from('2018-10-1')));
    $this->assertFalse($weekly->isValid(ImmutableDate::from('2018-10-3')));
  }

  public function testInPeriod(): void {
    $p1 = new InPeriod('R5/2012-01-01T12:00:00Z/P1D');
    $datePeriod = new \DatePeriod('R5/2012-01-01T12:00:00Z/P1D');
    $p2 = new InPeriod($datePeriod);
    $p3 = new InPeriod(new Period($datePeriod));
    $this->assertEquals($p1, $p2);
    $this->assertEquals($p1, $p3);
    $this->assertTrue($p1->isValid(ImmutableDate::from('2012-01-01')));
    $this->assertTrue($p1->isValid(ImmutableDate::from('2012-01-05')));
    $this->assertTrue($p1->isValid(ImmutableDate::from('2012-01-06')));
    $this->assertFalse($p1->isValid(ImmutableDate::from('2012-01-07')));
    $this->expectException(InvalidArgumentException::class);
    new InPeriod(2);
  }

  public function testMonthly(): void {
    $monthly = new Monthly(31);
    $this->assertFalse($monthly->isValid(ImmutableDate::from('2018-11-01')));
    $this->assertFalse($monthly->isValid(ImmutableDate::from('2018-02-31')));
    $this->assertFalse($monthly->isValid(ImmutableDate::from('2018-11-02')));
  }

  public function betweeData(): array {
    $out = [];
    $out [] = ['2018-1-1', '2018-1-5'];
    $out [] = ['2018-1-1', '2018-1-1'];
    $out [] = ['2000-2-29', '2000-2-29'];
    return $out;
  }

  /**
   * @dataProvider betweeData
   * 
   * @param string $startStr
   * @param string $endStr
   * @return void
   */
  public function testBetween(string $startStr, string $endStr): void {
    $start = ImmutableDate::from($startStr);
    $end = ImmutableDate::from($endStr);
    $rule = new Between($start, $end);
    $this->assertTrue($rule->isValid(ImmutableDate::from($start)));
    $this->assertTrue($rule->isValid(ImmutableDate::from($end)));
    $this->assertFalse($rule->isValid($start->jumpDays(-1)));
    $this->assertFalse($rule->isValid($end->jumpDays(1)));
  }

  public function testBefore(): void {
    $before = new Before(ImmutableDate::from('2018-5-2'));
    $this->assertTrue($before->isValid(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($before->isValid(ImmutableDate::from('2018-11-02')));
  }

  public function testAfter(): void {
    $after = new After(ImmutableDate::from('2017-1-1'));
    $this->assertTrue($after->isValid(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($after->isValid(ImmutableDate::from('2016-11-02')));
  }

  public function testAnnual(): void {
    $annual = new Annual(5, 3);
    $this->assertTrue($annual->isValid(ImmutableDate::from('2018-5-3')));
    $this->assertFalse($annual->isValid(ImmutableDate::from('2018-12-02')));
  }

  public function testVaryingAnnual(): void {
    $varyingAnnual = new VaryingAnnual('%d-11-30 next Saturday');
    $this->assertTrue($varyingAnnual->isValid(ImmutableDate::from('2018-12-01')));
    $this->assertFalse($varyingAnnual->isValid(ImmutableDate::from('2018-12-02')));
    // $this->assertFalse($varyingAnnual->isValid('foo'));
  }

  public function testAnyOfDates(): void {
    $oneof = Factory::instance()->anyOfDates('2018-1-1', '2018-2-1', '2018-3-1', '2018-4-1');
    //$this->assertSame($oneof, $oneof->addDates('2018-3-1', '2018-4-1'));
    $this->assertTrue($oneof->isValid(ImmutableDate::from('2018-3-1')));
    $this->assertFalse($oneof->isValid(ImmutableDate::from('2018-5-1')));
  }

  public function testConstraints(): void {
    $constraints = new Constraints();
    $this->assertSame($constraints, $constraints->monthly(1));
    $this->assertSame($constraints, $constraints->after(ImmutableDate::from('2018-9-5')));
    $this->assertSame($constraints, $constraints->notUnique(ImmutableDate::from('2018-11-1')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2018-10-1')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2018-11-1')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2018-9-1')));
  }

  public function testInvalidArgumentFailure(): void {
    $constraints = new Constraints();
    $this->expectException(InvalidArgumentException::class);
    $constraints->monthly('foo');
  }

  public function testConstraintsFailure(): void {
    $constraints = new Constraints();
    $this->expectException(BadMethodCallException::class);
    $constraints->foo('bar');
  }

  public function testIs(): void {
    $date1 = ImmutableDate::from('2000-2-1');
    $constraints = new Constraints();
    $this->assertTrue($constraints->isValid($date1));
    $constraints->is(new After($date1));
    $this->assertFalse($constraints->isValid($date1->jumpDays(-1)));
    $this->assertFalse($constraints->isValid($date1));
    $this->assertTrue($constraints->isValid($date1->jumpDays(1)));
  }

  public function testIsNot(): void {
    $date1 = ImmutableDate::from('2000-2-1');
    $constraints = new Constraints();
    $this->assertTrue($constraints->isValid($date1));
    $constraints->isNot(new After($date1));
    $this->assertTrue($constraints->isValid($date1));
    $this->assertTrue($constraints->isValid($date1->jumpDays(-1)));
    $this->assertFalse($constraints->isValid($date1->jumpDays(1)));
  }

  public function testMultipleConstraints(): void {
    $constraints = new Constraints();
    $constraints->is(new After(ImmutableDate::from('2000-2-1')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2000-2-2')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2000-2-9')));
    $constraints->is(new AnyOfDates(ImmutableDate::from('2000-2-9')));
    $constraints->isNot(new AnyOfDates(ImmutableDate::from('2000-2-11')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2000-2-9')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2000-2-11')));
  }

  public function testMagic1(): void {
    $constraints = new Constraints();
    $constraints->notAfter('now');
    $constraints->is()->weekdays(1, 2, 3);
    $this->assertTrue($constraints->isValid(ImmutableDate::from('last tuesday')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('next tuesday')));
    $constraints->is()->after('2021-1-1');
    $this->assertTrue($constraints->isValid(ImmutableDate::from('last monday')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2020-12 first monday')));
  }

  public function testMagicNot1(): void {
    $constraints = new Constraints();
    $constraints->notAfter('tomorrow');
    $constraints->notBefore('yesterday');
    $this->assertTrue($constraints->isValid(ImmutableDate::from('today')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('-2 days')));
  }

  public function testMagicNot2(): void {
    $constraints = new Constraints();
    $constraints->isNot()
            ->after('tomorrow')
            ->before('yesterday');
    $this->assertTrue($constraints->isValid(ImmutableDate::from('today')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('-2 days')));
  }

  public function testMagicNot3(): void {
    $constraints = new Constraints();
    $constraints->isNot(
            new After(ImmutableDate::from('tomorrow')),
            new Before(ImmutableDate::from('yesterday')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('today')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('-2 days')));
  }

  public function testIsAnyOf(): void {
    $constraints = new Constraints();
    $constraints->isAnyOf()
            ->annual(2, 1)
            ->annual(2, 2);
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-1-31')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2021-2-1')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2021-2-2')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-2-3')));
  }

  public function testDifferentSetsOfIsAnyOf(): void {
    $constraints = new Constraints();
    $constraints->isAnyOf()
            ->annual(2, 1)
            ->annual(2, 2);
    $constraints->isAnyOf()
            ->annual(2, 2)
            ->annual(2, 3)
            ->annual(2, 4);
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-1-31')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-2-1')));
    $this->assertTrue($constraints->isValid(ImmutableDate::from('2021-2-2')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-2-3')));
    $this->assertFalse($constraints->isValid(ImmutableDate::from('2021-2-4')));
  }

}
