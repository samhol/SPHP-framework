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
use Sphp\DateTime\DateTimes;
use DateTimeImmutable;
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Class DateTimesTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateTimesTest extends TestCase {

  /**
   * 
   * @return <int,<mixed, DateTimeImmutable>>
   */
  public function mixedParams(): array {
    $microtime = microtime(true);
    $timestamp = intval($microtime);
    $data[] = ['2020-2-2 11:00 EET', new DateTimeImmutable('2020-2-2 11:00 EET')];
    $data[] = [$timestamp, DateTimeImmutable::createFromFormat('U', (string) $timestamp)];
    $data[] = [-$timestamp, DateTimeImmutable::createFromFormat('U', (string) -$timestamp)];
    $data[] = [$microtime, DateTimeImmutable::createFromFormat('U.u', (string) $microtime)];
    $data[] = [-$microtime, DateTimeImmutable::createFromFormat('U.u', (string) -$microtime)];
    $dt = new \DateTime;
    $data[] = [$dt, DateTimeImmutable::createFromMutable($dt)];
    $date = new ImmutableDate;
    $data[] = [$date, $date->getDateTime()];
    $dateTime = new ImmutableDateTime;
    $data[] = [$dateTime, $dateTime->getDateTime()];
    return $data;
  }

  /**
   * @dataProvider mixedParams
   * 
   * @param  mixed $input
   * @param  DateTimeImmutable $expected
   * @return void
   */
  public function testGetDateTimeImmutableFromMixed($input, DateTimeImmutable $expected): void {
    $this->assertEquals($expected, DateTimes::dateTimeImmutable($input));
  }

  /**
   * @return void
   */
  public function testNullDateTimeImmutable(): void {
    $expected = date(DATE_ATOM);
    $fromNull = DateTimes::dateTimeImmutable(null)->format(DATE_ATOM);
    $this->assertSame($expected, $fromNull);
    $empty = DateTimes::dateTimeImmutable()->format(DATE_ATOM);
    $this->assertSame($expected, $empty);
  }

  /**
   * @return void
   */
  public function testAddMonths(): void {
    $dt = new DateTimeImmutable('2000-1-31');
    $this->assertEquals('2000-02-29', DateTimes::addMonths($dt, 1)->format('Y-m-d'));
    $this->assertEquals('2000-02-29', DateTimes::addMonths('2000-1-30', 1)->format('Y-m-d'));
    $this->assertEquals('2000-02-28', DateTimes::addMonths('2000-1-28', 1)->format('Y-m-d'));
    $this->assertEquals('2000-03-31', DateTimes::addMonths($dt, 2)->format('Y-m-d'));
    $this->assertEquals('2001-02-28', DateTimes::addMonths($dt, 13)->format('Y-m-d'));
    $this->assertEquals('2002-02-28', DateTimes::addMonths($dt, 25)->format('Y-m-d'));
    $this->assertEquals('1999-12-31', DateTimes::addMonths($dt, -1)->format('Y-m-d'));
  }

  public function invalidInputs(): array {
    $data[] = [new \stdClass()];
    $data[] = ['ö'];
    return $data;
  }

  /**
   * @dataProvider invalidInputs
   * 
   * @param  mixed $input
   * @return void
   */
  public function testInvalidDateTimeImmutableInput($input): void {
    $this->expectException(InvalidArgumentException::class);
    DateTimes::dateTimeImmutable($input);
  }

  /**
   * @dataProvider mixedParams
   * 
   * @param  mixed $param
   * @param  DateTimeImmutable $expected
   * @return void
   */
  public function testParseDateString($param, DateTimeImmutable $expected): void {
    $this->assertEquals($expected->format('Y-m-d'), DateTimes::parseDateString($param));
  }

  /**
   * @dataProvider invalidInputs
   * 
   * @param  mixed $input
   * @return void
   */
  public function testParseDateStringFailure($input): void {
    $this->expectException(InvalidArgumentException::class);
    DateTimes::parseDateString($input);
  }

}
