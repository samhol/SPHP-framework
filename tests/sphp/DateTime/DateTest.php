<?php

namespace Sphp\DateTime;

/**
 * @coversDefaultClass \Sphp\DateTime\Date
 */
class DateTest extends \PHPUnit\Framework\TestCase {

  protected function match(DateInterface $d1, DateInterface $d2) {
    $this->assertEquals($d1->format('Y-m-d'), $d2->format('Y-m-d'));
  }

  /**
   *
   * @covers ::__construct
   */
  public function testConstructor() {
    $timestamp = mktime();
    $now = new Date();
    $now1 = new Date('now');
    $this->assertEquals($now, $now1);
    $now2 = new Date('today');
    $this->assertEquals($now, $now2);
    $now3 = new Date($timestamp);
    $this->assertEquals($now, $now3);
    $now4 = new Date($timestamp);
    $this->assertEquals($now, $now4);
    $now5 = new Date(new \DateTime());
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
    $now = new Date();
    $match = new \DateTime('today');
    $this->assertEquals($now->format($needle), $match->format($needle));
  }

  /**
   * @covers ::__construct
   */
  public function testGetters() {
    $date = new Date();
    $this->assertSame((int) date('Y'), $date->getYear());
    $this->assertSame((int) date('n'), $date->getMonth());
    $this->assertSame((int) date('j'), $date->getMonthDay());
    $this->assertSame(date('l'), $date->getWeekDayName());
    $this->assertSame(date('F'), $date->getMonthName());
    $this->assertSame((int) date('W'), $date->getWeek());
  }

  /**
   *
   * @covers IntegerToRomanFilter::filter
   */
  public function testJumping() {

    $now1 = new Date();
    $now2 = new Date('today');
    $this->assertEquals($now1, $now2);
  }

}
