<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\Logs;
use Sphp\DateTime\Periods;

class LogTest extends TestCase {

  public function testWeekly() {
    $log = Logs::weekly([1, 2, 3, 7], 'Basketbal1');
    $period = Periods::weeksOfMonth(11);
    foreach ($period->toArray() as $date) {
      if (in_array($date->getWeekDay(), [1, 2, 3, 7])) {
        $this->assertTrue($log->dateMatchesWith($date));
      } else {
        $this->assertFalse($log->dateMatchesWith($date));
      }
    }
  }

}
