<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Interval;
use DateInterval;
use Sphp\DateTime\Exceptions\InvalidArgumentException;

class IntervalsTest extends TestCase {

  public function mixedData(): array {
    $out = [];
    $out[] = ['2 days + 3 hours '];
    $out[] = [(24 * 2 + 3) * 3600];
    $out[] = ['P2DT3H'];
    $out[] = [new DateInterval('P2DT3H')];
    $out[] = [new Interval('P2DT3H')];
    return $out;
  }

  /**
   * @dataProvider mixedData
   * 
   * @param  mixed $input
   * @return void
   */
  public function testCreate($input): void {
    $interval = Interval::create($input);
    $this->assertSame(51.0, $interval->toHours());
  }

  /**
   * @return <int, <in1, float>>
   */
  public function secondsData(): array {
    $out = [];
    $out[] = [0];
    $out[] = [0.1];
    $out[] = [-0.1];
    $out[] = [-1.1];
    $out[] = [1.100];
    return $out;
  }

  /**
   * @dataProvider secondsData
   * 
   * @param  float $seconds
   * @return void
   */
  public function testFromSeconds(float $seconds): void {
    $interval = Interval::fromSeconds($seconds);
    $this->assertSame((float) strstr((string) $seconds, '.'), $interval->f);
    $this->assertSame($seconds, $interval->toSeconds());
  }

  /**
   * @return <int, <in1, float>>
   */
  public function stringsData(): array {
    $out = [];
    $out[] = ['3:02:44', 'PT3H2M44S'];
    $out[] = ['3 hours + 2 minutes + 44 seconds', 'PT3H2M44S'];
    $out[] = ['1 days + 3 hours + 2 minutes + 44 seconds', 'P1DT3H2M44S'];

    return $out;
  }

  /**
   * @dataProvider stringsData
   * 
   * @param  float $seconds
   * @return void
   */
  public function testFromFormat(string $seconds, $expectedStr): void {
    $actual = Interval::fromString($seconds);
    $expected = Interval::fromString($expectedStr);
    $this->assertEquals($actual, $expected);
  }

  /**
   * @return void
   */
  public function testFromFormatFailure(): void {
    $this->expectException(InvalidArgumentException::class);
    Interval::fromString('foo');
  }

  public function fromFailureData(): array {
    $out = [];
    $out[] = ['foo'];
    $out[] = [new \stdClass()];
    $out[] = [false];
    $out[] = [true];
    $out[] = [null];

    return $out;
  }

  /**
   * @dataProvider fromFailureData
   * 
   * @param  mixed $input
   * @return void
   */
  public function testFromFailure($input): void {
    $this->expectException(InvalidArgumentException::class);
    Interval::create($input);
  }

}
