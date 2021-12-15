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
use Sphp\Apps\Calendars\Diaries\Holidays\Easter;

/**
 * The EasterTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EasterTest extends TestCase {

  public function testOConstructor(): void {
    $easter = new Easter();
    $this->assertSame((int) date('Y'), $easter->getYear());
    $easter2010 = new Easter(2010);
    $this->assertSame(2010, $easter2010->getYear());
  }

  public function years(): array {
    $set[] = [1860];
    $set[] = [2060];
    $set[] = [null];
    $set[] = [2020];
    return $set;
  }

  /**
   * @dataProvider years
   * 
   * @param int|null $year
   * @return void
   */
  public function testGetters(?int $year): void {
    $easter1 = new Easter($year);
    $easter2 = new Easter();
    if ($year === null) {
      $year = $easter2->getYear();
    }
    $this->assertEquals($easter1->getMaundyThursday(), $easter2->getMaundyThursday($year));
    $this->assertEquals($easter1->getGoodFriday(), $easter2->getGoodFriday($year));
    $this->assertEquals($easter1->getEasterSunday(), $easter2->getEasterSunday($year));
    $this->assertEquals($easter1->getEasterMonday(), $easter2->getEasterMonday($year));
    $this->assertEquals($easter1->getAscensionDay(), $easter2->getAscensionDay($year));
    $this->assertEquals($easter1->getPentecost(), $easter2->getPentecost($year));
  }

  /**
   * @dataProvider years
   * 
   * @param int|null $year
   * @return void
   */
  public function testTraversing(?int $year): void {
    $easter1 = new Easter($year);
    $this->assertEqualsCanonicalizing($easter1->toArray(), iterator_to_array($easter1));
  }

}
