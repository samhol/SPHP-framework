<?php

namespace Sphp\DateTime;

class DateTest extends \PHPUnit\Framework\TestCase {

  protected function match(DateInterface $d1, DateInterface $d2) {
    $this->assertEquals($d1->format('Y-m-d'), $d2->format('Y-m-d'));
  }

  public function testConstructor() {
    $timestamp = time();
    $now = new DateWrapper();
    $now1 = new DateWrapper('now');
    $this->assertEquals($now, $now1);
    $now2 = new DateWrapper('today');
    $this->assertEquals($now, $now2);
    $now3 = new DateWrapper($timestamp);
    $this->assertEquals($now, $now3);
    $now4 = new DateWrapper($timestamp);
    $this->assertEquals($now, $now4);
    $now5 = new DateWrapper(new \DateTime());
    $this->assertEquals($now, $now5);
  }

  /**
   * 
   * @return string[]
   */
  public function formats() {
    return [
        ['Y-m-d H:i:s'],
        ['Y-m-d H:i:s'],
    ];
  }

  /**
   *
   * @param string $needle
   * @dataProvider formats
   */
  public function testFormat($needle) {
    $now = new DateWrapper();
    $match = new \DateTime('today');
    $this->assertEquals($now->format($needle), $match->format($needle));
  }

  public function testGetters() {
    $date = new DateWrapper();
    $this->assertSame((int) date('Y'), $date->getYear());
    $this->assertSame((int) date('n'), $date->getMonth());
    $this->assertSame((int) date('j'), $date->getMonthDay());
    $this->assertSame(date('l'), $date->getWeekDayName());
    $this->assertSame(date('F'), $date->getMonthName());
    $this->assertSame((int) date('W'), $date->getWeek());
  }

  public function testJumping() {
    $now = new DateWrapper();
    $tomorrow = $now->jumpDays(1);
    $this->assertEquals(new DateWrapper('tomorrow'), $tomorrow);
    $yesterday = $now->jumpDays(-1);
    $this->assertEquals(new DateWrapper('yesterday'), $yesterday);
  }

}
