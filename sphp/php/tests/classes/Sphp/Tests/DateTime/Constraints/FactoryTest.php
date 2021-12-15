<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
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

/**
 * Class FactoryTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FactoryTest extends TestCase {

  public function createFailureData(): array {
    $out = [];
    $out [] = ['foo', ['2018-1-5']];
    $out [] = ['between', ['2018-1-1']];
    return $out;
  }

  /**
   * @dataProvider createFailureData
   * 
   * @param  string $name
   * @param  array $arguments
   * @return void
   */
  public function testCreateFailures(string $name, array $arguments): void {
    $this->expectException(InvalidArgumentException::class);
    Factory::instance()->create($name, $arguments);
  }

  public function testWeekdays(): void {
    $expected = new Weekdays(1, 5);
    $factorized = Factory::instance()->weekdays(1, 5);
    $this->assertEquals($expected, $factorized);
    $this->assertTrue($factorized->isValid(ImmutableDate::from('last monday')));
    $this->assertTrue($factorized->isValid(ImmutableDate::from('last friday')));
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
    $expected = new Monthly(1, 30);
    $factorized = Factory::instance()->monthly(1, 30);
    $this->assertEquals($expected, $factorized);
    $this->assertTrue($factorized->isValid(ImmutableDate::from('2018-1-01')));
    $this->assertFalse($factorized->isValid(ImmutableDate::from('2013-02-28')));
    $this->assertFalse($factorized->isValid(ImmutableDate::from('2018-12-31')));
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
    $expected = new Between($start, $end);
    $factorized = Factory::instance()->between($start, $end);
    $this->assertEquals($expected, $factorized);
    $this->assertTrue($factorized->isValid(ImmutableDate::from($start)));
    $this->assertTrue($factorized->isValid(ImmutableDate::from($end)));
    $this->assertFalse($factorized->isValid($start->jumpDays(-1)));
    $this->assertFalse($factorized->isValid($end->jumpDays(1)));
    $this->expectException(InvalidArgumentException::class);
    Factory::instance()->between('foo', 'bar');
  }

  public function testBefore(): void {
    $upperLimit = ImmutableDate::from('2018-5-2');
    $expected = new Before($upperLimit);
    $factorized = Factory::instance()->before('2018-5-2');
    $this->assertEquals($expected, $factorized);
    $this->assertTrue($factorized->isValid(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($factorized->isValid(ImmutableDate::from('2018-11-02')));
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

  public function testOneOf(): void {
    $d = ImmutableDate::from('2018-3-1');
    $dates[] = $d;
    $dates[] = $d->jumpDays(3);
    $dates[] = $d->jumpDays(-2);
    $dates[] = $d->jumpMonths(3);
    $expected = new AnyOfDates(...$dates);
    $dstrs = array_map('strval', $dates);
    $factorized = Factory::instance()->anyOfDates(...$dstrs);
    $this->assertEquals($expected, $factorized);
    foreach ($dates as $date) {
      $this->assertTrue($factorized->isValid($date));
      $this->assertFalse($factorized->isValid($date->jumpDays(-1)));
    }
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

}
