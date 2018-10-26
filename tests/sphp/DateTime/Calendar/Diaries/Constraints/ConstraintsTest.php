<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Calendar\Diaries\Constraints;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Calendars\Diaries\Constraints\Weekly;
use Sphp\DateTime\Calendars\Diaries\Constraints\Monthly;
use Sphp\DateTime\Calendars\Diaries\Constraints\InRange;
use Sphp\DateTime\Periods;

/**
 * Description of ConstraintsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ConstraintsTest extends TestCase {

  public function testWeekly() {
    $weekly = new Weekly(1, 2, 5);
    $period = Periods::days('2018-1-1', 7);
    foreach ($period->toArray() as $date) {
      if (in_array($date->getWeekDay(), [1, 2, 5])) {
        $this->assertTrue($weekly->isValidDate($date));
      } else {
        $this->assertFalse($weekly->isValidDate($date));
      }
    }
  }

  public function testMonthly() {
    $monthly = new Monthly(1);
    $monthly31 = new Monthly(31);
    $this->assertTrue($monthly->isValidDate('2018-11-01'));
    $this->assertFalse($monthly->isValidDate('2018-11-02'));
    $this->assertFalse($monthly31->isValidDate('2018-02-31'));
    $this->assertFalse($monthly31->isValidDate('2018-11-02'));
  }

  public function testInRange() {
    $range = new InRange('2018-1-1', '2018-1-5');
    $this->assertTrue($range->isValidDate('2018-1-1'));
    $this->assertTrue($range->isValidDate('2018-1-5'));
    $this->assertFalse($range->isValidDate('2018-11-02'));
    $this->assertFalse($range->isValidDate('2018-02-31'));
    $this->assertFalse($range->isValidDate('2017-01-6'));
  }

}
