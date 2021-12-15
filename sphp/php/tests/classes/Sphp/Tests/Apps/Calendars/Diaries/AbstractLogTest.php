<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\AbstractCalendarEntry;
use Sphp\DateTime\Periods;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Constraints\Factory;

class AbstractLogTest extends TestCase {

  public function testConstructorAndMatching(): void {
    $constraints = Factory::instance()->weekdays(1, 2, 3, 7);
    $entry = $this->getMockForAbstractClass(AbstractCalendarEntry::class, [$constraints]);
    $period = Periods::weeksOfMonth(11, 2002, 'P1D');
    foreach ($period->toArray() as $date) {
      $d = ImmutableDate::from($date);
      $this->assertSame($constraints->isValid($d), $entry->dateMatchesWith($d));
      $this->assertSame($constraints->isValid($d), $entry->dateRule()->isValid($d));
    }
  }

}
