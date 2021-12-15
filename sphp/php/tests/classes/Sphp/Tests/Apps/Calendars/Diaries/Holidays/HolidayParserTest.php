<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Calendars\Diaries\Holidays;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Calendars\Diaries\Holidays\HolidayParser;
use Sphp\Apps\Calendars\Diaries\Holidays\Holiday;
use Sphp\Apps\Calendars\Diaries\Holidays\BirthDay;

/**
 * The HolidayParserTesst class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HolidayParserTest extends TestCase {

  public function datapaths(): array {
    $paths = [];
    $paths[] = ['./sphp/php/tests/files/diaries/fi.yml'];
    $paths[] = ['./sphp/php/tests/files/diaries/easter.yml'];
    return $paths;
  }

  /**
   * @dataProvider datapaths
   * 
   * @param string $filePath
   * @return void
   */
  public function testFromYaml(string $filePath): void {
    $parser = new HolidayParser(2021);
    $diary = $parser->parseYamlFile($filePath);
    $this->assertTrue($diary->notEmpty());
    foreach ($diary as $holiday) {
      $this->assertInstanceOf(Holiday::class, $holiday);
    }
  }

  /**
   * @return void
   */
  public function testBirthdayOfADeadPersonFromYaml(): void {
    $parser = new HolidayParser(2021);
    $diary = $parser->parseYamlFile('./sphp/php/tests/files/diaries/dead.yml');
    $this->assertTrue($diary->notEmpty());
    foreach ($diary as $holiday) {
      $this->assertInstanceOf(BirthDay::class, $holiday);
      $this->assertNotNull($holiday->getDateOfDeath());
    }
  }

  /**
   * @return void
   */
  public function testBirthdayOfAnAlivePersonFromYaml(): void {
    $parser = new HolidayParser(2021);
    $diary = $parser->parseYamlFile('./sphp/php/tests/files/diaries/alive.yml');
    $this->assertTrue($diary->notEmpty());
    foreach ($diary as $holiday) {
      $this->assertInstanceOf(BirthDay::class, $holiday);
      $this->assertNull($holiday->getDateOfDeath());
    }
  }

}
