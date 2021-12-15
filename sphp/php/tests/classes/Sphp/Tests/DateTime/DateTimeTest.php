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

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\{
  Date,
  ImmutableDate,
  ImmutableDateTime,
  Interval
};
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use DateInterval;
use DateTimeZone;

class DateTimeTest extends TestCase {

  public function testGetters(): void {
    $timestamp = time();
    $date = ImmutableDateTime::from("@$timestamp");
    $im = new \DateTimeImmutable("@$timestamp");
    $this->assertSame($timestamp, $date->getTimestamp());
    $this->assertSame((int) $im->format('Y'), $date->getYear());
    $this->assertSame((int) $im->format('n'), $date->getMonth());
    $this->assertSame((int) $im->format('j'), $date->getMonthDay());
    $this->assertSame($im->format('l'), $date->getWeekDayName());
    $this->assertSame((int) $im->format('N'), $date->getWeekDay());
    $this->assertSame($im->format('F'), $date->getMonthName());
    $this->assertSame((int) $im->format('W'), $date->getWeek());
    $this->assertSame((int) $im->format('H'), $date->getHours());
    $this->assertSame((int) $im->format('i'), $date->getMinutes());
    $this->assertSame((int) $im->format('s'), $date->getSeconds());
    $this->assertSame($im->getTimezone()->getName(), $date->getTimeZoneName());
    $this->assertSame((int) $im->getOffset(), $date->getTimeZoneOffset());
    $this->assertEquals($im->format('Y-m-d H:i:s.u T'), "$date");
  }

  public function testJumping(): void {
    $timestamp = time();
    $date = ImmutableDateTime::from("@$timestamp");
    $this->assertEquals($date, $date->jumpDays(1)->jumpDays(-1));
    $this->assertEquals($date, $date->jumpHours(1)->jumpHours(-1));
  }

  public function testModificators(): void {
    $timestamp = time();
    $date = ImmutableDateTime::from("@$timestamp");
    $this->assertEquals($date->modify('-1 day'), $date->jumpDays(-1));
    $this->assertEquals($date->modify('+1 day'), $date->jumpDays(1));
    $this->assertEquals($date->modify('first day of this month'), $date->firstOfMonth());
    $this->assertEquals($date->modify('last day of this month'), $date->lastOfMonth());
  }

  public function dateComparisonData(): array {
    $data = [];
    $data[] = [
        ImmutableDateTime::from('2000-1-1'),
        ImmutableDateTime::from('2000-1-2'),
        ImmutableDateTime::from('2000-1-3')];
    $data[] = [
        ImmutableDateTime::from('2018-01-01 12:30 CET'),
        ImmutableDateTime::from('2018-01-02 12:30 EET'),
        ImmutableDateTime::from('2018-01-03 00:30 CET')];
    return $data;
  }

  /**
   * @dataProvider dateComparisonData
   * 
   * @param Date $s
   * @param Date $m
   * @param Date $l
   * @return void
   */
  public function testCompareDateTo(Date $s, Date $m, Date $l): void {

    $this->assertEquals(0, $s->compareDateTo($s));
    $this->assertEquals(1, $m->compareDateTo($s));
    $this->assertEquals(0, $m->compareDateTo($m));
    $this->assertEquals(-1, $m->compareDateTo($l));
    $this->assertEquals(1, $l->compareDateTo($s));
    $this->assertEquals(1, $l->compareDateTo($m));
  }

  public function testComparison(): void {
    $smaller = ImmutableDateTime::from('2018-01-01');
    $date = ImmutableDateTime::from('2018-01-02 12:30 EET');
    $bigger = ImmutableDateTime::from('2018-01-03');
    $this->assertEquals(1, $date->compareTo($smaller));
    $this->assertTrue($date->compareTo($smaller) > 0);
    $this->assertFalse($date->compareTo(ImmutableDateTime::from('2018-01-02 12:30 EET')) > 0);
    $this->assertFalse($date->compareTo($bigger) > 0);
    $this->assertEquals(0, $date->compareTo(clone $date));
    $this->assertEquals(-1, $date->compareTo($bigger));
    $this->assertTrue($date->compareTo($bigger) < 0);
    $this->assertFalse($date->dateEqualsTo($smaller));
    $this->assertFalse($date->dateEqualsTo($bigger));
    $this->assertTrue($date->dateEqualsTo(ImmutableDateTime::from('2018-01-02 15:00')));
    $this->assertFalse($date->isCurrentDate());
    $this->assertTrue(ImmutableDateTime::from()->isCurrentDate());
  }

  public function testFromMicroSeconds(): void {
    $ms = ImmutableDateTime::from(100.123456);
    $this->assertSame(123456, $ms->getMicroseconds());
  }

  public function testFrom(): void {
    $fromString = ImmutableDateTime::from('2018-01-01 12:00:15 EET');
    $this->assertSame(strtotime('2018-01-01 12:00:15 EET'), $fromString->getTimestamp());
    $this->assertEquals(ImmutableDateTime::from($fromString), $fromString);
    $fromString1 = ImmutableDateTime::from('yesterday');
    $this->assertSame(strtotime('yesterday'), $fromString1->getTimestamp());
    $fromInt = ImmutableDateTime::from(time());
    $timestamp = time();
    $delta = $timestamp * 0.0001;

    $this->assertEqualsWithDelta(time(), $fromInt->getTimestamp(), $delta);
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

  public function testSetTime(): void {
    $hour = 2;
    $minute = 2;
    $second = 2;
    $microsecond = 2;
    $original = new ImmutableDateTime();
    $newTime = $original->setTime($hour, $minute, $second, $microsecond);
    $this->assertSame($hour, $newTime->getHours());
    $this->assertSame($minute, $newTime->getMinutes());
    $this->assertSame($second, $newTime->getSeconds());
    $this->assertSame($microsecond, $newTime->getMicroseconds());
    $this->assertSame($original->getYear(), $newTime->getYear());
    $this->assertSame($original->getMonth(), $newTime->getMonth());
    $this->assertSame($original->getMonthDay(), $newTime->getMonthDay());
    $this->assertNotSame($original, $newTime);
    $year = 2010;
    $month = 11;
    $day = 2;
    $newDate = $original->setDate($year, $month, $day);
    $this->assertSame($year, $newDate->getYear());
    $this->assertSame($month, $newDate->getMonth());
    $this->assertSame($day, $newDate->getMonthDay());
    $this->assertSame($original->getHours(), $newDate->getHours());
    $this->assertSame($original->getMinutes(), $newDate->getMinutes());
    $this->assertSame($original->getSeconds(), $newDate->getSeconds());
    $this->assertSame($original->getMicroseconds(), $newDate->getMicroseconds());
  }

  public function testDiff(): void {
    $now = new ImmutableDateTime();
    $yesterday = $now->jumpDays(-1);
    $this->assertSame($yesterday->getMicroseconds(), $now->getMicroseconds());
    $tomorrow = $now->jumpDays(1);
    //print_r($now->diff($yesterday));
    //print_r($now->diff($tomorrow));
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

  public function createFromFormatData(): array {
    $out = [];
    $out[] = ['j-M-Y', '15-Feb-2009'];
    return $out;
  }

  /**
   * @dataProvider createFromFormatData
   * 
   * @param  string $format
   * @param  string $time 
   * @param  \DateTimeZone $timezone
   * @return void
   */
  public function testCreateFromFormat(string $format, string $time, \DateTimeZone $timezone = null): void {
    $dt = ImmutableDateTime::createFromFormat($format, $time, $timezone);
    $dti = \DateTimeImmutable::createFromFormat($format, $time, $timezone);
    $this->assertEquals($dti, $dt->getDateTime());
  }

  public function invalidCreateFromFormatData(): array {
    $out = [];
    $out[] = ['j-M-Y', 'foo'];
    return $out;
  }

  /**
   * @dataProvider invalidCreateFromFormatData
   * 
   * @param  string $format
   * @param  string $time 
   * @param  \DateTimeZone $timezone
   * @return void
   */
  public function testCreateFromFormatFailure(string $format, string $time, \DateTimeZone $timezone = null): void {
    $this->expectException(InvalidArgumentException::class);
    $dt = ImmutableDateTime::createFromFormat($format, $time, $timezone);
    $dti = \DateTimeImmutable::createFromFormat($format, $time, $timezone);
    $this->assertEquals($dti, $dt->getDateTime());
  }

  public function addAndSubData(): array {
    $out = [];
    $out[] = [new Interval('P2D')];
    $out[] = [new DateInterval('P2DT2H4M1S')];
    return $out;
  }

  /**
   * @dataProvider addAndSubData
   * 
   * @param  mixed $interval
   * @return void
   */
  public function testAddAndSub($interval): void {
    $dt = ImmutableDateTime::from(100);

    $dti = new \DateTimeImmutable("@100");
    $addDt = $dt->add($interval);
    $this->assertNotSame($dti, $addDt);
    $addDti = $dti->add($interval);
    $this->assertEquals($addDt->format(DATE_ATOM), $addDti->format(DATE_ATOM));
    $subDt = $addDt->sub($interval);
    $subDti = $addDti->sub($interval);
    $this->assertEquals($subDt->format(DATE_ATOM), $subDti->format(DATE_ATOM));
    $this->assertEquals($dt, $subDt);
    $this->assertEquals($dti, $subDti);
  }

  public function testTimezoneManipulation(): void {
    $ids = DateTimeZone::listIdentifiers();
    $curr = date_default_timezone_get();
    $currentTimezone = new DateTimeZone($curr);
    $dt = ImmutableDateTime::from('2000-4-4 12:00 CET');
    foreach ($ids as $id) {
      $expected = new DateTimeZone($id);
      $new = $dt->setTimezone($expected);
      $this->assertNotSame($new, $dt->setTimezone($expected));
      $this->assertEquals($expected, $new->getTimeZone());
      $this->assertSame($id, $new->getTimeZone()->getName());
      $this->assertSame($expected->getOffset($new->getDateTime()), $new->getOffset());
      $new1 = $dt->useCurrentTimezone();
      $this->assertNotSame($dt, $new1);
      $this->assertEquals($currentTimezone, $new1->getTimeZone());
      $this->assertSame($curr, $new1->getTimeZone()->getName());
    }
  }

  /**
   * @return void
   */
  public function testToDate(): void {
    $dateTime = ImmutableDateTime::from('2000-1-1 12:00 EET');
    $date = ImmutableDate::from('2000-1-1');
    $this->assertEquals($date, $dateTime->toDate());
  }

  /**
   * @return void
   */
  public function testJumpMonths(): void {
    $dt = ImmutableDateTime::from('2000-1-31');
    $this->assertEquals('2000-02-29', ImmutableDateTime::from('2000-1-31')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-02-29', ImmutableDateTime::from('2000-1-30')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-02-28', ImmutableDateTime::from('2000-1-28')->jumpMonths(1)->format('Y-m-d'));
    $this->assertEquals('2000-03-31', $dt->jumpMonths(2)->format('Y-m-d'));
    $this->assertEquals('2001-02-28', $dt->jumpMonths(13)->format('Y-m-d'));
    $this->assertEquals('2001-02-28', $dt->jumpMonths(1)->jumpYears(1)->format('Y-m-d'));
    $this->assertEquals('2001-01-31', $dt->jumpYears(1)->format('Y-m-d'));
    $this->assertEquals('2002-02-28', $dt->jumpMonths(25)->format('Y-m-d'));
    $this->assertEquals('1999-12-31', $dt->jumpMonths(-1)->format('Y-m-d'));
  }

  public function testCurrentus(): void {
    $now = ImmutableDateTime::now();
    $this->assertTrue($now->isCurrentDate());
    $this->assertTrue($now->isCurrentMonth());
    $this->assertTrue($now->isCurrentWeek());

    $past = ImmutableDateTime::from('2013-2-2');
    $this->assertFalse($past->isCurrentDate());
    $future = ImmutableDateTime::from((date('y') + 1) . '-1-11');
    $this->assertFalse($future->isCurrentDate());
  }

}
