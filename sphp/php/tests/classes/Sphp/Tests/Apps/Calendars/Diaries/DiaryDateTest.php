<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDate;
use Sphp\Apps\Calendars\Diaries\DiaryDate;
use Sphp\Apps\Calendars\Diaries\Logs;

/**
 * The DiaryDateTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DiaryDateTest extends TestCase {

  public function testConstructor(): void {
    $date = new ImmutableDate();
    $diaryDate = new DiaryDate($date);
    $this->assertEquals($date, $diaryDate->getDate());
    $this->assertCount(0, $diaryDate);
    $this->assertEmpty($diaryDate);
    $this->assertFalse($diaryDate->notEmpty());
    $this->assertEmpty($diaryDate->toArray());
    $this->assertFalse($diaryDate->isFlagDay());
    $this->assertFalse($diaryDate->isHoliday());
    $this->assertFalse($diaryDate->isNationalHoliday());
  }

  public function testHolidays(): void {
    $date = ImmutableDate::from('2000-12-6');
    $holiday = Logs::holiday()->annual([12, 6], 'baz');
    $national = Logs::holiday()->annual([12, 6], 'foo')->setNationalHoliday();
    $flagDay = Logs::holiday()->annual([12, 6], 'bar')->setFlagDay('fi');
    $diaryDate = new DiaryDate($date);
    $diaryDate->insertLog($holiday);
    $this->assertTrue($diaryDate->isHoliday());
    $this->assertFalse($diaryDate->isFlagDay());
    $diaryDate->insertLog($flagDay);
    $this->assertFalse($diaryDate->isNationalHoliday());
    $this->assertTrue($diaryDate->isFlagDay());
    $diaryDate->insertLog($national);
    $this->assertTrue($diaryDate->isNationalHoliday());
    $this->assertCount(3, $diaryDate);
  }

  public function testMerging(): void {
    $date = ImmutableDate::from('2000-12-6');
    $diaryDate = new DiaryDate($date);
    $holiday = Logs::holiday()->annual([12, 6], 'baz');
    $diaryDate->insertLog($holiday);
    $national = Logs::holiday()->annual([12, 6], 'foo')->setNationalHoliday();
    $diaryDate->insertLog($national);
    $flagDay = Logs::holiday()->annual([12, 6], 'bar')->setFlagDay();
    $diaryDate->insertLog($flagDay);
    $this->assertCount(3, $diaryDate);
    $diaryDate->merge($diaryDate);
    $this->assertCount(3, $diaryDate);
    $diaryDate->merge(clone $diaryDate);
    $this->assertCount(6, $diaryDate);
  }

  public function testDifferentEntryTypes(): void {
    $date = ImmutableDate::from('2000-12-6');
    $diaryDate = new DiaryDate($date);
    $l1 = Logs::log()->annual([12, 6], 'baz');
    $diaryDate->insertLog($l1);
    $l2 = Logs::holiday()->annual([12, 6], 'baz');
    $diaryDate->insertLog($l2);
    $l3 = Logs::holiday()->annual([12, 6], 'bar')->setFlagDay();
    $diaryDate->insertLog($l3);
    $this->assertCount(2, $diaryDate->getByType(\Sphp\Apps\Calendars\Diaries\Holidays\Holiday::class));
  }

}
