<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

class DateTest extends TestCase {

  public function testGetters() {
    $date = new Date('2000-01-01');
    $im = new \DateTimeImmutable('2000-01-01');
    $this->assertSame($im->getTimestamp(), $date->getTimestamp());
    $this->assertSame((int) $im->format('Y'), $date->getYear());
    $this->assertSame((int) $im->format('n'), $date->getMonth());
    $this->assertSame((int) $im->format('j'), $date->getMonthDay());
    $this->assertSame($im->format('l'), $date->getWeekDayName());
    $this->assertSame((int) $im->format('N'), $date->getWeekDay());
    $this->assertSame($im->format('F'), $date->getMonthName());
    $this->assertSame((int) $im->format('W'), $date->getWeek());
    $this->assertEquals($im->format('Y-m-d'), "$date");
  }

  public function testJumping() {
    $timestamp = time();
    $date = new Date("@$timestamp");
    $this->assertEquals($date, $date->jumpDays(1)->jumpDays(-1));
  }

  public function testModificators() {
    $timestamp = time();
    $date = new Date("@$timestamp");
    $this->assertEquals($date->modify('-1 day'), $date->previousDay());
    $this->assertEquals($date->modify('+1 day'), $date->nextDay());
    $this->assertEquals($date->modify('first day of this month'), $date->firstOfMonth());
    $this->assertEquals($date->modify('last day of this month'), $date->lastOfMonth());
  }

  public function testComparison() {
    $smaller = new Date('2018-01-01');
    $date = new Date('2018-01-02');
    $bigger = new Date('2018-01-03');
    $this->assertEquals(1, $date->compareTo($smaller));
    $this->assertEquals(0, $date->compareTo(clone $date));
    $this->assertEquals(-1, $date->compareTo($bigger));
    $this->assertFalse($date->dateEqualsTo($smaller));
    $this->assertFalse($date->dateEqualsTo($bigger));
    $this->assertTrue($date->dateEqualsTo('2018-01-02 15:00'));
    $this->assertFalse($date->dateEqualsTo('foo'));
    $this->assertFalse($date->dateEqualsTo(new \stdClass()));
    $this->assertFalse($date->isCurrentDate());
    $this->assertTrue((new Date)->isCurrentDate());
  }

  public function testFrom() {
    $fromString = DateTime::from('2018-01-01 12:00:15 EET');
    $this->assertSame(strtotime('2018-01-01 12:00:15 EET'), $fromString->getTimestamp());
    $fromString1 = DateTime::from('yesterday');
    $this->assertSame(strtotime('yesterday'), $fromString1->getTimestamp());
    $fromInt = DateTime::from(time());
    $this->assertSame(time(), $fromInt->getTimestamp());
    $fromObj = DateTime::from(new \DateTime('now'));
    $this->assertSame(strtotime("now"), $fromObj->getTimestamp());
  }

  public function testFromWithInvalidStringInput() {
    $this->expectException(InvalidArgumentException::class);
    DateTime::from('foo');
  }

  public function testFromWithInvalidInputType() {
    $this->expectException(InvalidArgumentException::class);
    DateTime::from(new \stdClass());
  }

}
