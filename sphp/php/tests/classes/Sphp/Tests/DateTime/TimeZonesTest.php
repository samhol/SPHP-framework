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
use DateTimeImmutable;
use Sphp\DateTime\Exceptions\InvalidArgumentException;
use DateTimeZone;
use Sphp\DateTime\Interval;
use Sphp\DateTime\TimeZones;

/**
 * Class DateTimesTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TimeZonesTest extends TestCase {

  public function invalidDateTimeZoneParameters(): array {
    $data[] = ['now'];
    $data[] = [''];
    return $data;
  }

  /**
   * @dataProvider invalidDateTimeZoneParameters
   * 
   * @param  mixed $input
   * @return void
   */
  public function testParseDateTimeZoneFailure($input): void {
    $this->expectException(InvalidArgumentException::class);
    TimeZones::fromString($input);
  }

  public function validDateTimeZoneParameters(): array {
    $data[] = ['Europe/Helsinki'];
    $data[] = ['Europe/London'];
    return $data;
  }

  /**
   * @dataProvider validDateTimeZoneParameters
   * 
   * @param  string $input
   * @return void
   */
  public function testParseDateTimeZone(string $input): void {
    $tz = TimeZones::fromString($input);
    $this->assertEquals($input, $tz->getName());
  }

  /**
   * @return void
   */
  public function testParseDefaultDateTimeZone(): void {
    $defaultName = date_default_timezone_get();
    $this->assertEquals($defaultName, TimeZones::fromString()->getName());
    $this->assertEquals($defaultName, TimeZones::fromString(null)->getName());
  }

  public function validDateTimeZoneHours(): array {
    $data[] = [-2];
    $data[] = [2];
    $data[] = [3];
    return $data;
  }

  /**
   * @dataProvider validDateTimeZoneHours
   * 
   * @param  float $hours
   * @return void
   */
  public function testDateTimeZoneFromHours(float $hours): void {
    $utcTime = new DateTimeImmutable('2000-1-1 12:00 UTC');
    $offsetSecs = 3600 * $hours;
    $interval = Interval::fromSeconds($offsetSecs);
    //   echo $offsetString = $interval->format("%R%H:%I");
    $tz = TimeZones::fromHours($hours);
    $this->assertEquals($offsetSecs, $tz->getOffset($utcTime));
  }

  public function invalidDateTimeZoneHours(): array {
    $data[] = [-13];
    $data[] = [-12.1];
    $data[] = [14.1];
    $data[] = [15];
    return $data;
  }

  /**
   * @dataProvider invalidDateTimeZoneHours
   * 
   * @param  float $hours
   * @return void
   */
  public function testDateTimeZoneFromHoursFalure(float $hours): void {
    $this->expectException(InvalidArgumentException::class);
    TimeZones::fromHours($hours);
  }

  /**
   * @return void
   */
  public function testDateTimeZoneIds(): void {

    $ids = \DateTimeZone::listIdentifiers();
    //print_r($ids);
    $utcTime = new DateTimeImmutable('2000-1-1 12:00 UTC');
    foreach ($ids as $id) {
      //  echo "\nid: $id";
      $expected = new DateTimeZone($id);
      $this->assertEquals($expected, TimeZones::fromString($id));
      $offsetSecs = $expected->getOffset($utcTime);
      $fromInt = TimeZones::fromSeconds($offsetSecs);
      $this->assertEquals($offsetSecs, $fromInt->getOffset($utcTime));
      $interval = Interval::fromSeconds($offsetSecs);

      $offsetString = $interval->format("%R%H:%I");
      $fromOffset = TimeZones::fromString($offsetString);
      $this->assertEquals($offsetSecs, $fromOffset->getOffset($utcTime));
      // echo "\n, " . $fromOffset->getName() . ':' . $fromOffset->getOffset($utcTime);
      $this->assertEquals($offsetSecs, $fromOffset->getOffset($utcTime));
    }
  }

}
