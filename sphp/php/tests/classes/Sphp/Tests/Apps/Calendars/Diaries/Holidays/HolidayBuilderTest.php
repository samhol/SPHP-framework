<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Holidays;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDate;
use Sphp\Apps\Calendars\Diaries\Holidays\HolidayBuilder;
use Sphp\Apps\Calendars\Diaries\Holidays\Holiday;
use Sphp\DateTime\Constraints\Factory;

class HolidayBuilderTest extends TestCase {

  public function testBase(): HolidayBuilder {
    $holidayBuilder = new HolidayBuilder();
    $log = $holidayBuilder->buildInstance(Factory::instance()->annual(1, 2), 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    return $holidayBuilder;
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testWeekly(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->weekly([1], 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-10-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-10-3')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testMonthly(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->monthly(31, 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-11-01')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-02-31')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-11-02')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testBetween(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->between(['2018-1-1', '2018-1-5'], 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-4')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2017-12-31')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2017-01-6')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testBefore(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->before('2018-5-2', 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-11-02')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testAfter(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->after('2017-1-1', 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2016-11-02')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testAnnual(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->annual([5, 3], 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-5-3')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-12-02')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testVaryingAnnual(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->varyingAnnual('%d-11-30 next Saturday', 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-12-01')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-12-02')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testOneOf(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->anyOfDates(['2018-1-1', '2018-2-1'], 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-5-1')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testUnique(HolidayBuilder $holidayBuilder): void {
    $log = $holidayBuilder->unique('2018-1-1', 'foo');
    $this->assertInstanceOf(Holiday::class, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-5-1')));
  }

  /**
   * @depends testBase
   * 
   * @param  HolidayBuilder $holidayBuilder
   * @return void
   */
  public function testBirthday(HolidayBuilder $holidayBuilder): void {
    $bd1 = $holidayBuilder->birthday('2018-1-1', 'foo bar');
    $this->assertTrue($bd1->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $bd2 = $holidayBuilder->birthday('2018-2-2', 'foo bar baz', '2018-3-3');
    $this->assertTrue($bd2->dateMatchesWith(ImmutableDate::from('2018-2-2')));
    $this->assertFalse($bd2->dateMatchesWith(ImmutableDate::from('2018-3-3')));
    $this->assertSame('2018-02-02', $bd2->getDateOfBirth()->format('Y-m-d'));
    $this->assertSame('2018-03-03', $bd2->getDateOfDeath()->format('Y-m-d'));
    $this->assertSame('foo bar baz', $bd2->getName());
  }

}
