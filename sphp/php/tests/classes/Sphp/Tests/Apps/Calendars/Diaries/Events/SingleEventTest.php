<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Events;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\Events\SingleEvent;
use Sphp\DateTime\DateTime;
use Sphp\DateTime\Interval;
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
    $data[] = ['foo', ImmutableDateTime::from('2000-1-1 12:00 EEST'), new Interval('P2D')];
    $data[] = ['foo', ImmutableDateTime::from('2000-1-1 12:00 EEST'), new Interval('P2D')];
    return $data;
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  string $name
   * @param  DateTime $start
   * @param  Interval $duration
   * @return void
   */
  public function testConstructor(string $name, DateTime $start, Interval $duration): void {
    $end = $start->add($duration);
    $evt = new SingleEvent($name, $start, $duration);
    $this->assertSame($name, $evt->getName());
    $this->assertSame($start, $evt->getStart());
    $this->assertEquals($start->add($duration), $evt->getEnd());
    $this->assertTrue($evt->dateMatchesWith($start));
    $this->assertFalse($evt->dateMatchesWith($start->jumpDays(-1)));
    $this->assertTrue($evt->dateMatchesWith($start));
    $this->assertFalse($evt->dateMatchesWith($end->jumpDays(1)));
    $this->assertEquals($duration, $evt->getDuration());
  }

  /**
   * @dataProvider constructorParameters
   *   
   * @param  string $name
   * @param  DateTime $start
   * @param  Interval $duration
   * @return void
   */
  public function testGettersAndSetters(string $name, DateTime $start, Interval $duration): void {
    $evt = new SingleEvent($name, $start, $duration);
    $this->assertSame($evt, $evt->setData($data = new \stdClass()));
    $this->assertSame($data, $evt->getData());
    $this->assertSame($evt, $evt->setDescription($description = 'foobar'));
    $this->assertSame($description, $evt->getDescription());
  }

}
