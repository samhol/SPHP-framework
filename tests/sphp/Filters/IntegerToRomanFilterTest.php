<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\RuntimeException;

class IntegerToRomanFilterTest extends TestCase {

  public function integerToRomanMap(): array {
    return [
        [1, 'I'],
        [4, 'IV'],
        [5, 'V'],
        [6, 'VI'],
        [123, 'CXXIII'],
    ];
  }

  /**
   * @dataProvider integerToRomanMap
   * 
   * @param int $int
   * @param string $roman
   */
  public function testValid(int $int, string $roman) {
    $filter = new IntegerToRomanFilter();
    $this->assertEquals($roman, $filter->filter($int));
    $this->assertEquals($roman, $filter($int));
    $this->assertEquals($filter->filter((string) $int), $roman);
    $this->assertEquals($filter((string) $int), $roman);
  }

  public function invalidData(): array {
    return [
        [new \stdClass()],
        [[1]],
        ['foo'],
        [null],
        [false],
        [true],
        [0],
    ];
  }

  /**
   * @dataProvider invalidData
   * 
   * @param int $int
   * @param string $roman
   */
  public function testInvalidStrings($invalid) {
    $filter = new IntegerToRomanFilter();
    $this->expectException(RuntimeException::class);
    $filter->filter($invalid);
  }

}
