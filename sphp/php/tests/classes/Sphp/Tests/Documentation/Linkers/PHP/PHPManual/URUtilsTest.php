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
use Sphp\Documentation\Linkers\PHP\PHPManual\URLUtils;

/**
 * The URUtilsTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class URUtilsTest extends TestCase {

  public function classNames(): iterable {
    yield [\ReflectionClass::class, 'reflectionclass'];
    yield ['UI\Draw\Text\Font\fontFamilies', 'ui-draw-text-font-fontfamilies'];
    yield ['UI\Window ', 'ui-window '];
  }

  /**
   * @dataProvider classNames
   * 
   * @param  string $class
   * @param  string $expected
   * @return void
   */
  public function testClassName(string $class, string $expected): void {
    $this->assertSame($expected, URLUtils::parseClassName($class));
  }

  public function functionNames(): iterable {
    yield ['easter_date', 'easter-date'];
    yield ['UI\Draw\Text\Font\fontFamilies', 'ui-draw-text-font-fontfamilies'];
  }

  /**
   * @dataProvider functionNames
   * 
   * @param  string $class
   * @param  string $expected
   * @return void
   */
  public function testParseFuctionName(string $class, string $expected): void {
    $this->assertSame($expected, URLUtils::parseFunctionName($class));
  }

  public function methodNames(): iterable {
    yield ['easter_date', 'easter-date'];
    yield ['UI\Draw\Text\Font\fontFamilies', 'ui-draw-text-font-fontfamilies'];
    yield ['UI\Window ', 'ui-window '];
  }

}
