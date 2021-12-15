<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\ClassConstantPathBuilder;

/**
 * The ClassConstantPathBuilderTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClassConstantPathBuilderTest extends TestCase {

  /**
   * @return iterable<string, string, string>
   */
  public function constantsData(): iterable {
    yield [\DateTime::class, 'COOKIE', "class.datetimeinterface.php#datetime.constants.cookie"];
    yield [\DateTimeImmutable::class, 'COOKIE', "class.datetimeinterface.php#datetime.constants.cookie"];
    yield [\DateTimeInterface::class, 'COOKIE', "class.datetimeinterface.php#datetime.constants.cookie"];
  }

  /**
   * @dataProvider constantsData
   * 
   * @param  string $class
   * @param  string $constant
   * @param  string $expected
   * @return void
   */
  public function testGetPath(string $class, string $constant, string $expected): void {
    $builder =  ClassConstantPathBuilder::instance();
    $this->assertSame($expected, $builder($class, $constant));
  }

}
