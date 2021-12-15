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
use Sphp\DateTime\Period;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\DateTime\Intervals;

class PeriodTest extends TestCase {

  public function testContains(): Period {
    $period = Period::fromISO('R5/2012-01-01T19:00:00Z/P1D');
    $this->assertFalse($period->contains(ImmutableDateTime::from('2012-01-01')->jumpDays(-1)));
    $this->assertCount(6, $period);
    $this->assertCount(6, $period->toArray());
    foreach ($period as $key => $dateTime) {
      $this->assertSame(2012, $dateTime->getYear());
      $this->assertSame((1 + $key), $dateTime->getMonthDay());
      $this->assertTrue($period->contains($dateTime));
    }
    $next = $dateTime->jumpDays(1);
    $this->assertFalse($period->contains($next), "$next should not belong to the period");
    $this->assertFalse($period->contains($dateTime->jumpDays(1)));
    return $period;
  }
  public function testFromIso():void {
    $period = Period::fromISO('R5/2012-01-01T19:00:00Z/P1D');
    $this->assertFalse($period->contains(ImmutableDateTime::from('2012-01-01')->jumpDays(-1)));
    $this->assertCount(6, $period);
    $this->assertCount(6, $period->toArray());
    foreach ($period as $key => $dateTime) {
      $this->assertSame(2012, $dateTime->getYear());
      $this->assertSame((1 + $key), $dateTime->getMonthDay());
      $this->assertTrue($period->contains($dateTime));
    }
    $next = $dateTime->jumpDays(1);
    $this->assertFalse($period->contains($next), "$next should not belong to the period");
    $this->assertFalse($period->contains($dateTime->jumpDays(1)));
  }

  public function testGetters(): void {
    $period = Period::fromISO('R5/2012-01-01T19:00:00Z/P1D');
    $this->assertEquals(ImmutableDateTime::from('2012-01-01T19:00:00Z'), $period->getStartDate());

    $this->assertSame('2012-01-06 19:00:00', $period->getEndDate()->format('Y-m-d H:i:s'));
    $this->assertEquals(Intervals::fromString('P1D'), $period->getInterval());
  }

  public function isInPeriod(Period $p, $date): void {
    $this->assertTrue($p->contains($date), "$date should not belong to the period");
    $this->assertTrue($p->contains($date));
  }

  public function isNotInPeriod(Period $p, $date): void {
    $this->assertFalse($p->contains($date), "$date should not belong to the period");
    $this->assertFalse($p->contains($date));
  }

  public function testConstraints(): void {
    $period = Period::fromISO('R5/2012-01-01T12:00:00Z/P1D');
    $this->assertCount(6, $period);
    $period->restrictions()->notAnyOfDates('2012-01-03');
    $this->assertCount(5, $period);
  }

}
