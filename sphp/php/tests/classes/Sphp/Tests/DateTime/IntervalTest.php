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
use Sphp\DateTime\Intervals;
use Sphp\DateTime\Interval;

class IntervalTest extends TestCase {

  public function testdateString() {
    $interval = Intervals::create('+2 days');
    $this->assertSame(2.0, $interval->toDays());
  }

  public function intervalStrings(): array {
    $strings[] = ['P0Y0M2DT1H22M1S', 'P2DT1H22M1S'];
    $strings[] = ['P0Y1M0DT0H0M0S', 'P1M'];
    $strings[] = ['P0Y0M0DT0H3M0S', 'PT3M'];
    $strings[] = ['P1Y0M0DT0H3M0S', 'P1YT3M'];
    $strings[] = ['-P1Y0M0DT0H3M0S', '-P1YT3M'];
    return $strings;
  }

  /**
   * @dataProvider intervalStrings
   */
  public function testToString(string $interval_spec, string $expected) {
    $interval = new Interval($interval_spec);
    $fromstr = new Interval("$interval");
    $this->assertSame($expected, "$interval");
    $this->assertSame(0, $fromstr->compareTo($interval));
  }

  public function testArithmetics() {
    $interval = new Interval('P1DT1H');
    $sum = $interval->add(new Interval('P1M1DT2H3M'));
    $this->assertSame('P1M2DT3H3M', "$sum");
    $div = $interval->add(new Interval('-P1M1DT2H3M'));
    $this->assertSame('P1DT1H', "$div");
  }

  public function testGetters(): void {
    $hours = 3;
    $minutes = 3;
    $interval = new Interval( );
    $interval->h = $hours;
    $this->assertEquals($hours, $interval->toHours());
    $interval->i = $minutes;
    $expectedHours = $hours + $minutes / 60;
    $this->assertEquals($expectedHours, $interval->toHours());
    $expectedMinutes = 60 * $hours + $minutes;
    $this->assertEquals($expectedMinutes, $interval->toMinutes());
  }

  public function comparisonData(): array {
    $strings[] = ['P1DT4H31M1S', 'P1DT4H31M2S', 'P1DT4H31M3S'];
    $strings[] = ['-P1DT4H31M1S', 'P1DT4H31M2S', 'P1DT4H31M3S'];
    return $strings;
  }

  /**
   * @dataProvider comparisonData
   * 
   * @param string $small
   * @param string $middle
   * @param string $large
   * @return void
   */
  public function testCompareTo(string $small, string $middle, string $large): void {

    $l = new Interval($large);
    $m = new Interval($middle);
    $s = new Interval($small);

    $this->assertSame(0, $l->compareTo($l));
    $this->assertSame(1, $l->compareTo($s));
    $this->assertSame(1, $l->compareTo($m));
    $this->assertSame(-1, $m->compareTo($l));
    $this->assertSame(1, $m->compareTo($s));
  }

  public function mixedData(): array {
    $out = [];
    $out[] = ['2 days + 3 hours '];
    return $out;
  }

  /**
   * @dataProvider mixedData
   * 
   * @param  mixed $input
   * @return void
   */
  public function testFrom($input): void {
    $interval = Interval::createFromDateString($input);
    $this->assertSame(51.0, $interval->toHours());
  }

  public function testOutputting(): void {
    $d = new Interval();
    $this->assertEquals(30, $d->addHours(.5)->toMinutes());
    $this->assertEquals(.5, $d->addDays(.5)->toDays());
    $this->assertEquals(12, $d->addDays(.5)->toHours());

    $this->assertEquals('1:30:00', $d->addHours(1.5)->format('%h:%I:%S'));
    $this->assertEquals('1 days 1:30:31.300000', $d->addHours(25.5)->addSeconds(31.3)->format('%d days %h:%I:%S.%f'));
  }

  public function testAddFromString(): void {
    $i1 = new Interval();
    $this->assertEquals(27, $i1->addFromString('P1DT3H')->toHours());
    $i2 = new Interval();
    $this->assertSame($i2, $i2->addFromString('P1DT3H2M4S'));
    $this->assertEquals(new Interval('P1DT3H'), $i1);
  }

  public function testAddParts(): void {
    $d = new Interval();
    $this->assertSame(2.1, $d->addSeconds(2.1)->toSeconds());
    $this->assertEquals(30, $d->addHours(.5)->toMinutes());
    $this->assertEquals(.5, $d->addDays(.5)->toDays());
    $this->assertEquals(12, $d->addDays(.5)->toHours());

    $this->assertEquals('1:30:00', $d->addHours(1.5)->format('%h:%I:%S'));
    $this->assertEquals('1 days 1:30:31.300000', $d->addHours(25.5)->addSeconds(31.3)->format('%d days %h:%I:%S.%f'));
  }

}
