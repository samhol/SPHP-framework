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

  abstract public function buildWriter(): ArrayParser;

  /**
   * @return array
   */
  abstract public function validFileToArrayData(): array;

  /**
   * @dataProvider validFileToArrayData
   * @param  string $string
   * @param  array $expected
   * @return void
   */
  public function testStringToArray(string $string, array $expected): void {
    $writer = $this->buildWriter();
    $raw = \Sphp\Stdlib\Filesystem::toString($string);
   // echo "\n$raw\n";
   // print_r($writer->stringToArray($raw));
    $this->assertIsArray( $writer->stringToArray($raw));
  }

  /**
   * @dataProvider validFileToArrayData
   * 
   * @param string $path
   * @param array $expected
   * @return void
   */
  public function testFileToArray(string $path, array $expected): void {
    $writer = $this->buildWriter();
    $this->assertSame($expected, $writer->fileToArray($path));
  }

  /**
   * @return void
   */
  public function testMissingFileToArray(): void {
    $writer = $this->buildWriter();
    $this->expectException(\Exception::class);
    $writer->fileToArray('foo.file');
  }

  /**
   * @return array
   */
  abstract public function validWritingPairs(): array;

  /**
   * @dataProvider validWritingPairs
   * @param mixed $data
   * @param string $expected
   * @return void
   */
  public function testWrite($data, string $expected): void {
    $writer = $this->buildWriter();
    $this->assertSame($expected, $writer->toString($data));
  }

  /**
   * @return array
   */
  abstract public function invalidWritingPairs(): array;

  /**
   * @dataProvider invalidWritingPairs
   * @param mixed $data
   * @param string $exceptionType
   * @return void
   */
  public function testInvalidWrite($data, string $exceptionType): void {
    $writer = $this->buildWriter();
    $this->expectException($exceptionType);
    $writer->toString($data);
  }

}
