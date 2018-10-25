<?php

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\DateTime;

class DateTimeTest extends TestCase {

  /**
   * @var DateTime
   */
  protected $dateTime;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->dateTime = new DateTime();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->dateTime);
  }

  public function testGetters() {
    $timestamp = time();
    $date = new DateTime("@$timestamp");
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
    $this->assertEquals($im->format(\DateTime::ATOM), "$date");
  }

  public function testJumping() {
    $timestamp = time();
    $date = new DateTime("@$timestamp");
    $this->assertEquals($date, $date->jumpDays(1)->jumpDays(-1));
    $this->assertEquals($date, $date->jumpHours(1)->jumpHours(-1));
    $this->assertEquals($date, $date->jumpMonths(1)->jumpMonths(-1));
  }

  public function testModificators() {
    $timestamp = time();
    $date = new DateTime("@$timestamp");
    $this->assertEquals($date->modify('-1 day'), $date->previousDay());
    $this->assertEquals($date->modify('+1 day'), $date->nextDay());
    $this->assertEquals($date->modify('first day of this month'), $date->firstOfMonth());
    $this->assertEquals($date->modify('last day of this month'), $date->lastOfMonth());
  }

  public function testComparison() {
    $smaller = new DateTime("2018-01-01");
    $date = new DateTime("2018-01-02 12:30");
    $bigger = new DateTime("2018-01-03");
    $this->assertEquals(1, $date->compareTo($smaller));
    $this->assertEquals(0, $date->compareTo(clone $date));
    $this->assertEquals(-1, $date->compareTo($bigger));
    $this->assertFalse($date->dateEqualsTo($smaller));
    $this->assertFalse($date->dateEqualsTo($bigger));
    $this->assertTrue($date->dateEqualsTo("2018-01-02 15:00"));
    $this->assertFalse($date->dateEqualsTo('foo'));
    $this->assertFalse($date->dateEqualsTo(new \stdClass()));
    $this->assertFalse($date->isCurrentDate());
    $this->assertTrue(DateTime::from()->isCurrentDate());
  }
}
