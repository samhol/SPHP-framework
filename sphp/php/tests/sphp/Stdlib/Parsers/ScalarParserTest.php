<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

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

  public function validParseIntData(): array {
    return [
        ['1', 1],
        [' 1 ', 1],
        [true, 1],
        [false, 0],
        [1.2, 1],
        [1.6, 1],
        ['1.6', 1],
        [new \Sphp\Html\PlainContainer(1), 1],
    ];
  }

  /**
   * @dataProvider validParseIntData
   * 
   * @param  mixed $raw
   * @param  int $expected
   * @return void
   */
  public function testValidParseInt($raw, int $expected): void {
    $this->assertEquals($expected, ScalarParser::parseInt($raw));
  }

  public function invalidParseIntData(): array {
    return [
        ['foo'],
        [new \stdClass()],
    ];
  }

  /**
   * @dataProvider invalidParseIntData
   * 
   * @param  mixed $raw
   * @return void
   */
  public function testInvalidParseInt($raw): void {
    $this->expectException(InvalidArgumentException::class);
    ScalarParser::parseInt($raw);
  }

  public function validParseFloatData(): array {
    return [
        ['-1.3', -1.3],
        [' 1 ', 1],
        [true, 1],
        [false, 0],
        [1.2, 1.2],
        [new \Sphp\Html\PlainContainer(1), 1],
    ];
  }

  /**
   * @dataProvider validParseFloatData
   * 
   * @param  mixed $raw
   * @param  float $expected
   * @return void
   */
  public function testValidParseFloat($raw, float $expected): void {
    $this->assertEquals($expected, ScalarParser::parseFloat($raw));
  }

  public function invalidParseFloatData(): array {
    return [
        ['foo'],
        [new \stdClass()],
    ];
  }

  /**
   * @dataProvider invalidParseFloatData
   * 
   * @param  mixed $raw
   * @return void
   */
  public function testInvalidParseFloat($raw): void {
    $this->expectException(InvalidArgumentException::class);
    ScalarParser::parseFloat($raw);
  }

}
