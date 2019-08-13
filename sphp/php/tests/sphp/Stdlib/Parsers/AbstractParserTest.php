<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of AbstractParserTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractParserTest extends TestCase {

  abstract public function buildWriter(): Writer;

  /**
   * @return array
   */
  abstract public function validWritingPairs(): array;

  /**
   * @dataProvider validWritingPairs
   * @param mixed $data
   * @param string $expected
   */
  public function testWrite($data, string $expected) {
    $writer = $this->buildWriter();
    $this->assertSame($expected, $writer->write($data));
  }

  /**
   * @return array
   */
  abstract public function invalidWritingPairs(): array;

  /**
   * @dataProvider invalidWritingPairs
   * @param mixed $data
   * @param string $exceptionType
   */
  public function testInvalidWrite($data, string $exceptionType) {
    $writer = $this->buildWriter();
    $this->expectException($exceptionType);
    $writer->write($data);
  }

}
