<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Parsers\ScalarParser;

/**
 * 
 * @testdox ScalarParser class tests
 */
class ScalarParserTest extends TestCase {

  public function validIntegerToRomanData(): array {
    return [
        [1, 'I'],
        [4, 'IV'],
        [5, 'V'],
        [6, 'VI'],
        [123, 'CXXIII'],
    ];
  }

  /**
   * @dataProvider validIntegerToRomanData
   * 
   * @param int $int
   * @param string $roman
   */
  public function testValidIntegerToRoman(int $int, string $roman): void {
    $this->assertEquals($roman, ScalarParser::integerToRoman($int));
  }

  public function invalidIntegerToRomanData(): array {
    $data = [];
    $data[] = [0];
    $data[] = [-1];
    return $data;
  }

  /**
   * @dataProvider invalidIntegerToRomanData
   * 
   * @param  int $int
   * @return void
   */
  public function testIntegerToRomanFailure(int $int): void {
    $this->expectException(InvalidArgumentException::class);
    ScalarParser::integerToRoman($int);
  }

  public function validOrdinalizeData(): array {
    return [
        [1, '1st'],
        [2, '2nd'],
        [3, '3rd'],
    ];
  }

  /**
   * @dataProvider validOrdinalizeData
   * 
   * @param int $int
   * @param string $ord
   */
  public function testValidOrdinalize(int $int, string $ord): void {
    $this->assertEquals($ord, ScalarParser::ordinalize($int));
  }

  public function invalidOrdinalizeData(): array {
    $data = [];
    $data[] = [0];
    $data[] = [-1];
    return $data;
  }

  /**
   * @dataProvider invalidOrdinalizeData
   * 
   * @param  int $int
   * @return void
   */
  public function testFailure(int $int): void {
    $this->expectException(InvalidArgumentException::class);
    ScalarParser::ordinalize($int);
  }

}
