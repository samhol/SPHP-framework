<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\I18n;

use PHPUnit\Framework\TestCase;
use Sphp\I18n\Datetime\CalendarUtils;
use Sphp\I18n\Exceptions\InvalidArgumentException;

/**
 * Class CalendarTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CalendarTest extends TestCase {

  /**
   * @return void
   */
  public function testWeekDays(): void {
    $cal = new CalendarUtils("en_US.utf-8");
    $this->assertSame('Sunday', $cal->getWeekdayName(7));
    $this->assertSame($cal, $cal->setLocale("fi_fi.utf-8"));
    $this->assertSame('sunnuntai', $cal->getWeekdayName(7));
    $days = $cal->getWeekdays();
    $days_2 = $cal->getWeekdays(2);
    foreach ($days as $no => $name) {
      $this->assertSame($name, $cal->getWeekdayName($no));
      $this->assertSame($days_2[$no], $cal->getWeekdayName($no, 2));
    }
    $this->assertSame($cal, $cal->setFirstDayOfWeek(7));
    $sundayFirst = $cal->getWeekdays();
    $this->assertSame($cal->getWeekdayName(7), $sundayFirst[0]);
    $this->assertSame($cal->getWeekdayName(2), $sundayFirst[2]);
  }

  public function testMonths(): void {
    $cal = new CalendarUtils();
    $months = $cal->getMonths();
    $months_3 = $cal->getMonths(3);
    foreach ($months as $no => $name) {
      $this->assertSame($name, $cal->getMonthName($no));
      $this->assertSame($months_3[$no], $cal->getMonthName($no, 3));
    }
    $this->assertSame('January', $cal->getMonthName(1));
    $this->assertSame('November', $cal->getMonthName(11));
    $this->assertSame('Jan', $cal->getMonthName(1, 3));
    $this->assertSame('No', $cal->getMonthName(11, 2));
  }

  public function invalidWeekdayParameters(): array {
    $params = [];
    $params[] = [0, null, 0];
    $params[] = [-1, null, 0];
    $params[] = [8, null, 0];
    $params[] = [1, 0, 1];
    $params[] = [1, -1, 1];
    $params[] = [0, -1, 0];
    return $params;
  }

  /**
   * @dataProvider invalidWeekdayParameters
   * 
   * @param int $wd
   * @param int|null $length
   * @return void
   */
  public function testGetWeekdayNameFailures(int $wd, ?int $length, int $code): void {
    $cal = new CalendarUtils("en_US.utf-8");
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionCode($code);
    $cal->getWeekdayName($wd, $length);
  }

  public function invalidMonthNameParameters(): array {
    $params = [];
    $params[] = [0, null, 0];
    $params[] = [-1, null, 0];
    $params[] = [13, null, 0];
    $params[] = [1, 0, 1];
    $params[] = [1, -1, 1];
    $params[] = [0, -1, 0];
    $params[] = [13, -1, 0];
    return $params;
  }

  /**
   * @dataProvider invalidMonthNameParameters
   * 
   * @param int $month
   * @param int|null $length
   * @return void
   */
  public function testGetMonthNameFailures(int $month, ?int $length, int $code): void {
    $cal = new CalendarUtils("en_US.utf-8");
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionCode($code);
    $cal->getMonthName($month, $length);
  }

}
