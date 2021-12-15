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
use Sphp\DateTime\Date;

abstract class DateTest extends TestCase {

  abstract public function createDate(int $year, int $month, int $day): Date;

  /**
   * @return void
   */
  public function testConstructor(): void {
    $date = $this->createDate(2000, 12, 25);
    $this->assertSame("2000-12-25", $date->format('Y-n-j'));
    $this->assertSame(2000, $date->getYear());
    $this->assertSame(1, $date->getMonth());
    $this->assertSame(1, $date->getMonthDay());
  }

  public function testToday(): void {
    $year = (int) date('Y');
    $month = (int) date('n');
    $day = (int) date('j');
    $today = $this->createDate($year, $month, $day);
    $this->assertTrue($today->isCurrentDate());
    $this->assertTrue($today->isCurrentMonth());
    $this->assertTrue($today->isCurrentWeek());
  }

}
