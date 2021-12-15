<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Events;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\Events\PeriodicEvent;
use Sphp\DateTime\Interval;
use Sphp\DateTime\Period;

/**
 * The PeriodicEventTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PeriodicEventTest extends TestCase {

  public function constructorParameters(): array {
    $data = [];
    $data[] = ['foo', Period::fromISO('R4/2020-07-01T00:00:00Z/P7D'), new Interval('P2D')];
    return $data;
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  string $name
   * @param  Period $period
   * @param  Interval $duration
   * @return void
   */
  public function testConstructor(string $name, Period $period, Interval $duration): void {
    $start = $period->getStartDate();
    $end = $period->getEndDate()->add($duration);
    $evt = new PeriodicEvent($name, $period, $duration);
    $this->assertSame($name, $evt->getName());
    $this->assertSame($period, $evt->getPeriod());
    $this->assertEquals($period->getEndDate()->add($duration), $evt->getEnd());
    $this->assertTrue($evt->dateMatchesWith($start));
    $this->assertTrue($evt->dateMatchesWith($end));
    $this->assertFalse($evt->dateMatchesWith($period->getStartDate()->jumpDays(-1)));
    $this->assertFalse($evt->dateMatchesWith($period->getEndDate()->add($duration)->jumpDays(1)));
    $this->assertEquals($duration, $evt->getDuration());
  }

}
