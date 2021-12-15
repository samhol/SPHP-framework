<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\MutableDiary;
use Sphp\Apps\Calendars\Diaries\Logs;
use Sphp\DateTime\ImmutableDate;

class MutableDiaryTest extends TestCase {

  public function testEmptyConstructor(): void {
    $diary = new MutableDiary();
    $this->assertFalse($diary->notEmpty());
    $this->assertCount(0, $diary);
  }

  public function testConstructorWithLogs(): void {
    $logs = [];
    $logs[] = Logs::holiday()->unique('2021-2-4', 'a holiday', 'holiday description');
    $logs[] = Logs::log()->between(['2021-1-4', '2021-1-5'], 'a log', 'log description');

    $diary = new MutableDiary($logs);
    $this->assertTrue($diary->notEmpty());
    $this->assertCount(count($logs), $diary);
  }

  public function testInsertingLogs(): void {
    $logs = [];
    $logs[] = Logs::holiday()->unique('2021-2-4', 'a holiday', 'holiday description');
    $logs[] = Logs::log()->between(['2021-1-4', '2021-1-5'], 'a log', 'log description');

    $diary = new MutableDiary($logs);
    $this->assertTrue($diary->notEmpty());
    $this->assertCount(count($logs), $diary);
    $log1 = Logs::holiday()->unique('2001-12-2', 'Some log');
    $this->assertFalse($diary->containsLogs(ImmutableDate::from('2001-12-2')));
    $this->assertTrue($diary->insertLog($log1));
    $this->assertFalse($diary->insertLog($log1));
    $this->assertTrue($diary->containsLogs(ImmutableDate::from('2001-12-2')));
    $this->assertCount(count($logs) + 1, $diary);
    $this->assertTrue($diary->insertLog(clone $log1));
    $diaryDate = $diary->getDate(ImmutableDate::from('2001-12-2'));
    $this->assertCount(2, $diaryDate);
    $this->assertTrue($diaryDate->logExists($log1));
  }

  public function testMergingDiaries(): void {
    $logs = [];
    $logs[] = Logs::holiday()->unique('2021-2-4', 'a holiday', 'holiday description');
    $logs[] = Logs::log()->between(['2021-1-4', '2021-1-5'], 'a log', 'log description');

    $diary1 = new MutableDiary($logs);
    $cloned = clone $diary1;
    $diary2 = new MutableDiary($logs);
    $this->assertSame($diary1, $diary1->merge($diary1));
    $this->assertCount(count($logs), $diary1);
    $this->assertSame($diary1, $diary1->merge($cloned));
    $this->assertCount(count($logs) * 2, $diary1);
    $this->assertSame($diary1, $diary1->merge($diary2));
    $this->assertCount(count($logs) * 2, $diary1);
  }

  public function testTraversing(): void {
    $logs = [];
    $logs[] = Logs::holiday()->unique('2021-2-4', 'a holiday', 'holiday description');
    $logs[] = Logs::log()->between(['2021-1-4', '2021-1-5'], 'a log', 'log description');

    $diary = new MutableDiary($logs);
    $this->assertEqualsCanonicalizing(iterator_to_array($diary), $diary->toArray());
  }

}
