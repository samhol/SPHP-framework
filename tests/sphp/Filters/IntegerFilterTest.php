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
use Sphp\Exceptions\InvalidArgumentException;

class IntegerFilterTest extends TestCase {

  public function integerMap(): array {
    return [
        [1],
        [4],
        [5],
        [6.3],
        [123],
        [-123],
    ];
  }

  /**
   * @dataProvider integerMap
   * 
   * @param scalar $int
   */
  public function testValid($int) {
    $filter = new IntegerFilter(0, -10, 10);
    $filter->options = array(
        'options' => array(
            'default' => 3, // value to return if the filter fails
            // other options here
            'min_range' => 0
        ),
        'flags' => FILTER_FLAG_ALLOW_OCTAL,
    );
    $this->assertGreaterThanOrEqual(-10, $filter->filter($int));
    $this->assertGreaterThanOrEqual(-10, $filter->filter((string) $int));
  }

  public function invalidData(): array {
    return [
        [new \stdClass()],
        [[1]],
        ['foo'],
        [null],
        [false],
        [true],
    ];
  }

  /**
   * @dataProvider invalidData
   * @expectedException InvalidArgumentException
   * 
   * @param int $int
   * @param string $roman
   */
  public function t2estInval2idStrings($invalid) {
    $filter = new IntegerToRomanFilter();
    $filter->filter($invalid);
  }

}
