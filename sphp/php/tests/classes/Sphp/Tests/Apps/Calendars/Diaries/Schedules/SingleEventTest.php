<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Schedules;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\Schedules\SingleTask;
use Sphp\DateTime\Date;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Class SingleEventTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SingleEventTest extends TestCase {

  public function constructorParameters(): array {
    $data = [];
    $data[] = ['foo', ImmutableDate::from('2000-1-1'), ImmutableDate::from('2000-1-1')];
    $data[] = ['foo', ImmutableDate::from('2000-1-1'), ImmutableDate::from('2000-1-2 19:00 EET')];
    return $data;
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  string $name
   * @param  Date $start
   * @param  Date $end
   * @return void
   */
  public function testConstructor(string $name, Date $start, Date $end): void {
    $evt = new SingleTask($name, $start, $end);
    $this->assertSame($name, $evt->getName());
    $this->assertSame($start, $evt->getStart());
    $this->assertSame($end, $evt->getEnd());
    $this->assertTrue($evt->dateMatchesWith($start));
    $this->assertFalse($evt->dateMatchesWith($start->jumpDays(-1)));
    $this->assertTrue($evt->dateMatchesWith($end));
    $this->assertFalse($evt->dateMatchesWith($end->jumpDays(1)));
    $this->assertEquals($start->diff($end), $evt->getDuration());
  }

  /**
   * @dataProvider constructorParameters
   *   
   * @param string $name
   * @param Date $start
   * @param Date $end
   * @return void
   */
  public function testGettersAndSetters(string $name, Date $start, Date $end): void {
    $evt = new SingleTask($name, $start, $end);
    $this->assertSame($evt, $evt->setData($data = new \stdClass()));
    $this->assertSame($data, $evt->getData());
    $this->assertSame($evt, $evt->setDescription($description = 'foobar'));
    $this->assertSame($description, $evt->getDescription());
    $this->assertSame($evt, $evt->setName($name1 = 'name1'));
    $this->assertSame($name1, $evt->getName());
  }

}
