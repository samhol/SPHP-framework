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
use Sphp\Apps\Calendars\Diaries\LogFactory;
use Sphp\Apps\Calendars\Diaries\BasicLog;
use Sphp\Apps\Calendars\Diaries\Holidays\Holiday;
use Sphp\DateTime\ImmutableDate;

/**
 * The LogFactoryTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LogFactoryTest extends TestCase {

  public function logTypes(): array {
    $params = [];
    $params[] = [BasicLog::class];
    $params[] = [Holiday::class];
    return $params;
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testWeekly(string $typeName): void {
    $builder = new LogFactory($typeName);
    $this->assertSame($typeName, $builder->getClassName());
    $weekly = $builder->weekly([1], 'foo', 'bar');
    $this->assertInstanceOf($typeName, $weekly);
    $this->assertSame('foo', $weekly->getName());
    $this->assertSame('bar', $weekly->getDescription());
    $this->assertTrue($weekly->dateMatchesWith(ImmutableDate::from('2018-10-1')));
    $this->assertFalse($weekly->dateMatchesWith(ImmutableDate::from('2018-10-3')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testMonthly(string $typeName): void {
    $builder = new LogFactory($typeName);
    $monthly = $builder->monthly(31, 'foo');
    $this->assertInstanceOf($typeName, $monthly);
    $this->assertFalse($monthly->dateMatchesWith(ImmutableDate::from('2018-11-01')));
    $this->assertFalse($monthly->dateMatchesWith(ImmutableDate::from('2018-02-31')));
    $this->assertFalse($monthly->dateMatchesWith(ImmutableDate::from('2018-11-02')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testBetween(string $typeName): void {
    $builder = new LogFactory($typeName);
    $range = $builder->between(['2018-1-1', '2018-1-5'], 'foo');
    $this->assertInstanceOf($typeName, $range);
    $this->assertTrue($range->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertTrue($range->dateMatchesWith(ImmutableDate::from('2018-1-4')));
    $this->assertFalse($range->dateMatchesWith(ImmutableDate::from('2017-12-31')));
    $this->assertFalse($range->dateMatchesWith(ImmutableDate::from('2017-01-6')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testBefore(string $typeName): void {
    $builder = new LogFactory($typeName);
    $before = $builder->before('2018-5-2', 'foo');
    $this->assertInstanceOf($typeName, $before);
    $this->assertTrue($before->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($before->dateMatchesWith(ImmutableDate::from('2018-11-02')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testAfter(string $typeName): void {
    $builder = new LogFactory($typeName);
    $after = $builder->after('2017-1-1', 'foo');
    $this->assertInstanceOf($typeName, $after);
    $this->assertTrue($after->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($after->dateMatchesWith(ImmutableDate::from('2016-11-02')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testAnnual(string $typeName): void {
    $builder = new LogFactory($typeName);
    $annual = $builder->annual([5, 3], 'foo');
    $this->assertInstanceOf($typeName, $annual);
    $this->assertTrue($annual->dateMatchesWith(ImmutableDate::from('2018-5-3')));
    $this->assertFalse($annual->dateMatchesWith(ImmutableDate::from('2018-12-02')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testVaryingAnnual(string $typeName): void {
    $builder = new LogFactory($typeName);
    $log = $builder->varyingAnnual('%d-11-30 next Saturday', 'foo');
    $this->assertInstanceOf($typeName, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-12-01')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-12-02')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testAnyOfDates(string $typeName): void {
    $builder = new LogFactory($typeName);
    $log = $builder->anyOfDates(['2018-1-1', '2018-2-1'], 'foo');
    $this->assertInstanceOf($typeName, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-5-1')));
  }

  /**
   * @dataProvider logTypes
   * 
   * @param  string $typeName
   * @return void
   */
  public function testUnique(string $typeName): void {
    $builder = new LogFactory($typeName);
    $log = $builder->unique('2018-1-1', 'foo');
    $this->assertInstanceOf($typeName, $log);
    $this->assertTrue($log->dateMatchesWith(ImmutableDate::from('2018-1-1')));
    $this->assertFalse($log->dateMatchesWith(ImmutableDate::from('2018-5-1')));
  }

}
