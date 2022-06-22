<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Period;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\DateTime\Interval;
use Sphp\DateTime\Periods;
use Sphp\DateTime\DateTimes;
use Sphp\DateTime\Exceptions\{
  InvalidArgumentException
};

/**
 * The PeriodsTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PeriodsTest extends TestCase {

  public function testDays(): void {
    $period = Periods::days('2000-10-10 12:00', 10);
    $this->assertCount(11, $period);
    $p = new Period(new \DatePeriod(DateTimes::dateTimeImmutable('2000-10-10 12:00'), new Interval('P1D'), 10));
    $arr = iterator_to_array($p);
    // $this->assertEquals($p, $period);
    foreach ($period as $k => $day) {
      $this->assertSame($arr[$k]->format('Y-m-d H:i:s.u e'), $day->format('Y-m-d H:i:s.u e'));
    }
  }

  public function testWeeksOfMonth(): void {
    $period = Periods::weeksOfMonth(1, 2000, 'P1D');
    $arr = $period->toArray();
    foreach ($arr as $d) {
      // echo "\n" . $d->format('l');
    }
    $monday = array_shift($arr);
    $lastDay = array_pop($arr);
    $this->assertSame('Monday', $monday->format('l'));
    $this->assertSame('Sunday', $lastDay->format('l'));
  }

  public function validToStringParams(): array {
    $set[] = ['2012-2-2', 'P1D', 3];
    $set[] = ['2012-2-2', 'P1D', '2012-2-5'];
    return $set;
  }

  /**
   * @dataProvider validToStringParams
   * 
   * @param  mixed $start
   * @param  mixed $interval
   * @param  mixed $length
   * @return void
   */
  public function testCreate($start, $interval, $length): void {
    $startObj = DateTimes::dateTimeImmutable($start);
    $intervalObj = Interval::create($interval);
    $period = Periods::create($start, $interval, $length);
    if (!is_int($length)) {
      $length = DateTimes::dateTimeImmutable($length);
    }
    $p = new \DatePeriod($startObj, $intervalObj, $length);
    $arr = iterator_to_array($p);
    foreach ($period as $k => $day) {
      $this->assertSame($arr[$k]->format('Y-m-d H:i:s.u e'), $day->format('Y-m-d H:i:s.u e'));
    }
  }

  public function invalidToStringParams(): array {
    $set[] = ['2012-2-2', '', 3];
    $set[] = ['2012-2-2', 'bar', '2012-2-5'];
    $set[] = ['foo', 'P1D', '2012-2-5'];
    $set[] = ['2012-2-2', 'P1D', 'bar'];
    return $set;
  }

  /**
   * @dataProvider invalidToStringParams
   * 
   * @param  mixed $start
   * @param  mixed $interval
   * @param  mixed $length
   * @return void
   */
  public function testCreateFailure($start, $interval, $length): void {
    $this->expectException(InvalidArgumentException::class);
    Periods::create($start, $interval, $length);
  }

  public function testWeek(): void {
    $dateTime = new ImmutableDateTime();
    $monday = $dateTime->setISODate(2000, 1, 1);
    $period = Periods::week($monday);
    //echo DateTime::from('2000 first monday')->format('Y-m-d l W');
    $this->assertCount(7, $period);
    $this->assertEquals(Interval::create('P1D'), $period->getInterval());
    $this->assertEquals($monday, $period->getStartDate());
    $this->assertEquals($monday->jumpDays(6), $period->getEndDate());
    $this->expectException(InvalidArgumentException::class);
    Periods::week('foo');
  }

}
