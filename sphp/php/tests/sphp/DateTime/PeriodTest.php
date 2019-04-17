<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Period;

class PeriodTest extends TestCase {

  public function testFromIso(): Period {
    $period = Period::fromISO('R5/2012-01-01T19:00:00Z/P1D');
    $this->assertFalse($period->contains(\Sphp\DateTime\DateTime::from('2012-01-01')->jumpDays(-1)));
    $this->assertFalse($period->contains('foo'));
    $this->assertCount(6, $period);
    $this->assertCount(6, $period->toArray());
    foreach ($period as $key => $dateTime) {
      $this->assertSame(2012, $dateTime->getYear());
      $this->assertSame((1 + $key), $dateTime->getMonthDay());
      $this->assertTrue($period->containsDate($dateTime->format('Y-m-d')));
    }
    $next = $dateTime->jumpDays(1)->format('Y-m-d');
    $this->assertFalse($period->containsDate($next), "$next should not belong to the period");
    $this->assertFalse($period->contains($dateTime->jumpDays(1)));
    $this->assertFalse($period->containsDate('foo'));
    return $period;
  }

  public function isInPeriod(Period $p, $date) {
    $this->assertTrue($p->containsDate($date), "$date should not belong to the period");
    $this->assertTrue($p->contains($date));
  }
  
  public function isNotInPeriod(Period $p, $date) {
    $this->assertFalse($p->containsDate($date), "$date should not belong to the period");
    $this->assertFalse($p->contains($date));
  }
}
