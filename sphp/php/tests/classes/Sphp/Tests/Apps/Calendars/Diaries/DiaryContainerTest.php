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
use Sphp\Apps\Calendars\Diaries\DiaryContainer;
use Sphp\Apps\Calendars\Diaries\Logs;
use Sphp\Apps\Calendars\Diaries\MutableDiary;
use Sphp\DateTime\ImmutableDate;

/**
 * The DiaryContainerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DiaryContainerTest extends TestCase {

  public function testConstructor(): void {
    $cont = new DiaryContainer();
    $this->assertFalse($cont->notEmpty());
    $this->assertCount(0, $cont);
    $this->assertEmpty($cont);
    $this->assertEmpty($cont->toArray());
  }

  public function testInserting(): void {
    $diary = new MutableDiary();
    $diary->insertLog(Logs::log()->annual([2, 3], 'foo'));
    $diary->insertLog(Logs::log()->annual([5, 27], 'bar'));
    $cont = new DiaryContainer();
    $this->assertFalse($cont->containsDiary($diary));
    $this->assertTrue($cont->insertDiary($diary));
    $this->assertFalse($cont->insertDiary($diary));
    $this->assertCount(1, $cont);
    $this->assertTrue($cont->containsDiary($diary));
  }

  /**
   * @return DiaryContainer
   */
  public function testTraversing(): DiaryContainer {
    $cont = new DiaryContainer();
    $this->assertEmpty($cont);
    $logs = [];
    $logs[] = Logs::holiday()->unique('2021-4-3', 'a holiday', 'holiday description');
    $logs[] = Logs::log()->between(['2021-4-2', 'now'], 'a log', 'log description');

    $diary = new MutableDiary($logs);
    $cont->insertDiary($diary);
    $this->assertEqualsCanonicalizing(iterator_to_array($cont), $cont->toArray());
    return $cont;
  }
  /**
   * @depends testTraversing
   * 
   * @param DiaryContainer $cont
   */
  public function testgetDate(DiaryContainer $cont) {
    $diaryDate1 = $cont->getDate(ImmutableDate::from('2021-4-3'));
    $this->assertCount(2, $diaryDate1);
    $diaryDate2 = $cont->getDate(ImmutableDate::from('2021-4-1'));
    $this->assertCount(0, $diaryDate2);
  }

}
