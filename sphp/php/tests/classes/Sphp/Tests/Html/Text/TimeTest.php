<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Text;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Text\Time;
use Sphp\DateTime\DateTime;
use DateTimeInterface;
use Sphp\DateTime\ImmutableDateTime;
use DateInterval;
use Sphp\DateTime\Interval;

/**
 * The ConsoleTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimeTest extends TestCase {

  /**
   * @return void
   */
  public function testEmptyConstructor(): void {
    $time = new Time();
    $this->assertSame('<time></time>', (string) $time);
    $this->assertFalse($time->attributeExists('datetime'));
  }

  public function constructorDataProvider(): iterable {
    yield [ImmutableDateTime::from('now'), 'c'];
    yield [ImmutableDateTime::from('now'), 'c'];
    yield ['now', 'c'];
  }

  /**
   * @dataProvider constructorDataProvider
   * 
   * @param DateTime|DateTimeInterface|string $dateTime
   * @param string $format
   * @param mixed $content
   * @return void
   */
  public function testConstructorWithParams(DateTime|DateTimeInterface|string $dateTime, string $format = 'c'): void {
    $time = new Time('datetime');
    $this->assertSame("<time>datetime</time>", (string) $time);
    $this->assertSame($time, $time->setDateTime($dateTime));
    $this->assertTrue($time->attributeExists('datetime'));
     if (is_string($dateTime)) {
      $dateTime = ImmutableDateTime::from($dateTime);
    }
    $this->assertSame( $dateTime->format($format), $time->getAttribute('datetime'));
    $this->assertSame($time, $time->setDateTime(null));
    $this->assertFalse($time->attributeExists('datetime'));
  }

  /**
   * @return iterable<DateInterval>
   */
  public function durationDataProvider(): iterable {
    yield [DateInterval::createFromDateString('4 years')];
    yield [Interval::create('P2D')];
  }

  /**
   * @dataProvider durationDataProvider
   * 
   * @param  DateInterval DateInterval
   * @return void
   */
  public function testDuration(DateInterval $interval): void {
    $time = new Time('duration');
    $this->assertSame("<time>duration</time>", (string) $time);
    $this->assertSame($time, $time->useDuration($interval));
    $this->assertTrue($time->attributeExists('datetime'));
    $this->assertSame((string) Interval::create($interval), $time->getAttribute('datetime'));
    $this->assertSame($time, $time->useDuration(null));
    $this->assertFalse($time->attributeExists('datetime'));
  }

}
