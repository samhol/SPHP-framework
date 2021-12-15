<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Time;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

/**
 * The TimeTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimeTest extends TestCase {

  public function validTimeParts(): array {
    $set[] = [0, 0, 0];
    $set[] = [23, 59, 59];
    $set[] = [1, 2, 3];
    return $set;
  }

  /**
   * @dataProvider validTimeParts
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testConstructor(int $hours = 0, int $minutes = 0, float $seconds = 0): void {
    $time = new Time($hours, $minutes, $seconds);
    $this->assertSame($hours, $time->getHours());
    $this->assertSame($minutes, $time->getMinutes());
    $this->assertSame($seconds, $time->getSeconds());
  }

  public function invalidTimeParts(): array {
    $set[] = [-1, 0, 0];
    $set[] = [0, -1, 0];
    $set[] = [0, 0, -1];
    $set[] = [24, 0, 0];
    $set[] = [0, 60, 0];
    $set[] = [0, 0, 60];
    return $set;
  }

  /**
   * @dataProvider invalidTimeParts
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testInvalidConstructor(int $hours, int $minutes, float $seconds) {
    $this->expectException(InvalidArgumentException::class);
    new Time($hours, $minutes, $seconds);
  }

  public function validToStringParams(): array {
    $set[] = ['00:00', 0, 0, 0];
    $set[] = ['00:00:00.1', 0, 0, 0.1];
    $set[] = ['00:00', 0, 0, 0];
    $set[] = ['23:59:59.99', 23, 59, 59.99];
    $set[] = ['01:02:03', 1, 2, 3];
    $set[] = ['01:02:03', 1, 2, 3];
    $set[] = ['01:02:10', 1, 2, 10];
    return $set;
  }

  /**
   * @dataProvider validToStringParams
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testToString(string $str, int $hours, int $minutes, float $seconds): void {
    $time = new Time($hours, $minutes, $seconds);
    $this->assertSame($str, "$time");
  }

  public function validFromStringParams(): array {
    $set[] = ['0:0:0', 0, 0, 0];
    $set[] = ['0:0', 0, 0, 0];
    $set[] = ['00:00:00', 0, 0, 0];
    $set[] = ['23:59:59.99', 23, 59, 59.99];
    $set[] = ['1:2:3', 1, 2, 3];
    $set[] = ['1:02:03', 1, 2, 3];
    $set[] = ['1:02:10', 1, 2, 10];
    return $set;
  }

  /**
   * @dataProvider validFromStringParams
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testFromString(string $str, int $hours, int $minutes, float $seconds): void {
    $time = Time::fromString($str);
    $same = Time::from($str);
    $this->assertEquals($time, $same);
    $this->assertSame($hours, $time->getHours());
    $this->assertSame($minutes, $time->getMinutes());
    $this->assertSame($seconds, $time->getSeconds());
  }

  public function validFromParams(): array {
    $set[] = ['0:0:0', 0, 0, 0];
    $set[] = ['0:0', 0, 0, 0];
    $set[] = ['00:00', 0, 0, 0];
    $set[] = ['23:59:59', 23, 59, 59];
    $set[] = ['23:59:59.99', 23, 59, 59.99];
    $set[] = ['1:2:3', 1, 2, 3];
    $set[] = ['1:02:03', 1, 2, 3];
    $set[] = ['1:02:10', 1, 2, 10];
    $set[] = [$dt = new \DateTime(), (int) $dt->format('H'), (int) $dt->format('i'), (float) $dt->format('s.u')];
    return $set;
  }

  /**
   * @dataProvider validFromParams
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testFrom($from, int $hours, int $minutes, float $seconds): void {
    $time = Time::from($from);
    $this->assertSame($hours, $time->getHours());
    $this->assertSame($minutes, $time->getMinutes());
    $this->assertSame($seconds, $time->getSeconds());
  }

  public function invalidFromParams(): array {
    $set[] = ['24:0:0'];
    $set[] = ['2:60:0'];
    $set[] = ['2:10:60'];
    $set[] = ['2:10:15.9:30'];
    $set[] = ['2:2a:'];
    $set[] = ['daa'];
    $set[] = [new \stdClass()];
    $set[] = [123];
    return $set;
  }

  /**
   * @dataProvider invalidFromParams
   * 
   * @param  int $hours
   * @param  int $minutes
   * @param  int $seconds
   * @return void
   */
  public function testFromFailure($from): void {
    $this->expectException(InvalidArgumentException::class);
    echo Time::from($from);
  }

  /**
   * @return void
   */
  public function testFromNull(): void {
    $time = Time::from();
    $this->assertLessThan(24, $time->getHours());
    $this->assertLessThan(60, $time->getMinutes());
    $this->assertLessThanOrEqual(60, $time->getSeconds());
    $this->assertGreaterThanOrEqual(0, $time->getHours());
    $this->assertGreaterThanOrEqual(0, $time->getMinutes());
    $this->assertGreaterThanOrEqual(0, $time->getSeconds());
    $this->assertGreaterThanOrEqual(0, $time->getMicroSeconds());
  }

}
