<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use Sphp\DateTime\Date;
use DateTimeImmutable;

class ImmutableDateTest extends DateTest {

  public function createDate(int $year, int $month, int $day): Date {
    return ImmutableDate::from("$year-$month-$day");
  }

  public function testConstructor(): void {
    $im = new \DateTimeImmutable('2000-01-01');
    $date = new ImmutableDate($im);
    $now = new ImmutableDate();
    $this->assertSame($im->format('Y-m-d'), $date->format('Y-m-d'));
    $this->assertSame((int) date('Y'), $now->getYear());
    $this->assertSame((int) date('n'), $now->getMonth());
    $this->assertSame((int) date('j'), $now->getMonthDay());
  }

  public function diffDataSets() {
    $set[] = ['2001-1-1', true];
    $set[] = [new \DateTimeImmutable('2001-1-1'), false];
    $set[] = ['2001-1-1', false];
    return $set;
  }

  public function testDiff(): void {
    $now = new ImmutableDate();
    $yesterday = $now->jumpDays(-1);
    $tomorrow = $now->jumpDays(1);
    //print_r($now->diff($yesterday));
    $diff0 = $now->diff($yesterday);
    $this->assertSame(1, $diff0->d);
    $this->assertTrue($diff0->isNegative());
    $diff1 = $now->diff($yesterday, true);
    $this->assertSame(1, $diff1->d);
    $this->assertFalse($diff1->isNegative());
    $this->assertSame(1, $diff2 = $now->diff($tomorrow)->d);
    $this->expectException(InvalidArgumentException::class);
    $now->diff('foo');
  }

  public function testArithmetics(): void {
    $dob = ImmutableDate::from('1975-9-16');
    $birthDay1 = ImmutableDate::from('2020-9-16');
    $birthDay2 = ImmutableDateTime::from('2020-9-16');
    $dti = new \DateTimeImmutable('2020-9-16 12:00', new \DateTimeZone('Pacific/Nauru'));
    $birthDay3 = new ImmutableDateTime($dti);
    $this->assertSame(45, $dob->diff($birthDay1)->y);
    $this->assertSame(45, $dob->diff($birthDay2)->y);
    $this->assertSame(45, $dob->diff($birthDay3)->y);
  }

  public function testGetters(): void {
    $date = ImmutableDate::from('2000-01-01');
    $im = new \DateTimeImmutable('2000-01-01');
    $this->assertSame((int) $im->format('Y'), $date->getYear());
    $this->assertSame((int) $im->format('n'), $date->getMonth());
    $this->assertSame((int) $im->format('j'), $date->getMonthDay());
    $this->assertSame($im->format('l'), $date->getWeekDayName());
    $this->assertSame((int) $im->format('N'), $date->getWeekDay());
    $this->assertSame($im->format('F'), $date->getMonthName());
    $this->assertSame((int) $im->format('W'), $date->getWeek());
    $this->assertEquals($im->format('Y-m-d'), "$date");
  }

  public function testJumping(): void {
    $timestamp = time();
    $date = ImmutableDate::from("@$timestamp");
    $this->assertEquals($date, $date->jumpDays(1)->jumpDays(-1));
  }

  /**
   * @return void
   */
  public function testJumpMonths(): void {
    $dt = ImmutableDate::from('2000-1-31');
    $this->assertEquals('2000-02-29', ImmutableDate::from('2000-1-31')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-02-29', ImmutableDate::from('2000-1-30')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-02-28', ImmutableDate::from('2000-1-28')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-03-31', $dt->jumpMonths(2)->format('Y-m-d'));
    $this->assertEquals('2001-02-28', $dt->jumpMonths(13)->format('Y-m-d'));
    $this->assertEquals('2001-02-28', $dt->jumpMonths(1)->jumpYears(1)->format('Y-m-d'));
    $this->assertEquals('2001-01-31', $dt->jumpYears(1)->format('Y-m-d'));
    $this->assertEquals('2002-02-28', $dt->jumpMonths(25)->format('Y-m-d'));
    $this->assertEquals('1999-12-31', $dt->jumpMonths(-1)->format('Y-m-d'));
  }

  public function testModificators(): void {
    $dti = new DateTimeImmutable();
    $date = new ImmutableDate($dti);
    $yeaterday = new ImmutableDate($dti->modify('-1 day'));
    $this->assertEquals($yeaterday, $date->jumpDays(-1));
    $tomorrow = new ImmutableDate($dti->modify('+1 day'));
    $this->assertEquals($tomorrow, $date->jumpDays(1));

    $fdotm = new ImmutableDate($dti->modify('first day of this month'));
    $this->assertEquals($fdotm, $date->firstOfMonth());
    $ldotm = new ImmutableDate($dti->modify('last day of this month'));
    $this->assertEquals($ldotm, $date->lastOfMonth());
    }

    public function testComparison(): void {
    $smaller = ImmutableDate::from('2018-01-01');
    $date = ImmutableDate::from('2018-01-02');
    $bigger = ImmutableDate::from('2018-01-03');
    $this->assertEquals(1, $date->compareDateTo($smaller));
    $this->assertEquals(0, $date->compareDateTo(clone $date));
    $this->assertEquals(-1, $date->compareDateTo($bigger));
    $this->assertFalse($date->dateEqualsTo($smaller));
    $this->assertFalse($date->dateEqualsTo($bigger));
    $this->assertTrue($date->dateEqualsTo(ImmutableDateTime::from('2018-01-02 15:00')));
    $this->assertFalse($date->isCurrentDate());
    $this->assertTrue((new ImmutableDate)->isCurrentDate());
  }

  public function testFrom(): void {
    $fromString = ImmutableDateTime::from('2018-01-01 12:00:15 EET');
    $this->assertSame(strtotime('2018-01-01 12:00:15 EET'), $fromString->getTimestamp());
    $fromString1 = ImmutableDateTime::from('yesterday');
    $this->assertSame(strtotime('yesterday'), $fromString1->getTimestamp());
    $fromInt = ImmutableDateTime::from(time());
    $this->assertSame(time(), $fromInt->getTimestamp());
    $fromObj = ImmutableDateTime::from(new \DateTime('now'));
    $this->assertSame(strtotime("now"), $fromObj->getTimestamp());
  }

  public function testFromWithInvalidStringInput(): void {
    $this->expectException(InvalidArgumentException::class);
    ImmutableDateTime::from('foo');
  }

  public function testFromWithInvalidInputType(): void {
    $this->expectException(InvalidArgumentException::class);
    ImmutableDateTime::from(new \stdClass());
  }

  public function mkDateSets(): array {
    $data[] = [1, 2, 2020];
    $data[] = [31, 2, 2020];
    $data[] = [41, 2, 2020];
    $data[] = [41, 2, -2020];
    return $data;
  }

  /**
   * @dataProvider mkDateSets
   * 
   * @param int $day
   * @param int $month
   * @param int $year
   * @return void
   */
  public function testMkDate(int $day, int $month, int $year): void {
    $date = ImmutableDate::mkDate($day, $month, $year)->format('Y-m-d');
    $expected = date('Y-m-d', mktime(0, 1, 0, $month, $day, $year));
    $this->assertSame($expected, $date);
  }

  public function fromFormatSets(): array {
    $data[] = ['Y-m-!d H:i:s', '2009-02-15 15:16:17', new \DateTimeZone('Europe/London')];
    return $data;
  }

  /**
   * 
   * @param int $day
   * @param int $month
   * @param int $year
   * @return void
   */
  public function testFromFormat(): void {
    $date = ImmutableDate::createFromFormat('Y-m-!d H:i:s', '2009-02-15 15:16:17', new \DateTimeZone('Europe/London'))->format('Y-m-d');
    $expected = \DateTimeImmutable::createFromFormat('Y-m-!d H:i:s', '2009-02-15 15:16:17', new \DateTimeZone('Europe/London'))->format('Y-m-d');
    $this->assertSame($expected, $date);
    $this->expectException(InvalidArgumentException::class);
    ImmutableDate::createFromFormat('Y-foo css', '2009-02-15 15:16:17');
  }

  public function testCurrentus(): void {
    $now = ImmutableDate::now();
    $this->assertTrue($now->isCurrentDate());
    $this->assertTrue($now->isCurrentMonth());
    $this->assertTrue($now->isCurrentWeek());

    $past = ImmutableDate::from('2013-2-2');
    $this->assertFalse($past->isCurrentDate());
    $future = ImmutableDate::from((date('y') + 1) . '-1-11');
    $this->assertFalse($future->isCurrentDate());
  }

  public function testSetDate(): void {

    $original = new ImmutableDate();

    $year = 2010;
    $month = 11;
    $day = 2;
    $newDate = $original->setDate($year, $month, $day);
    $this->assertSame($year, $newDate->getYear());
    $this->assertSame($month, $newDate->getMonth());
    $this->assertSame($day, $newDate->getMonthDay());
  }

}
