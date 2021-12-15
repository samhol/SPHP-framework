<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Parsers\ArrayParser;
use Sphp\Stdlib\Filesystem;

/**
 * Implementation of AbstractParserTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractParserTest extends TestCase {

  abstract public function buildArrayParser(): ArrayParser;

  abstract public function validFileToArrayData(): iterable;

  /**
   * @dataProvider validFileToArrayData
   * @param  string $string
   * @param  array $expected
   * @return void
   */
  public function testStringToArray(string $string, array $expected): void {
    $parser = $this->buildArrayParser();
    $raw = Filesystem::toString($string);
    //echo "\n" . get_class($parser) . "\n";
    //var_dump($parser->stringToArray($raw),$expected);
    $this->assertSame($expected, $parser->stringToArray($raw));
  }

  /**
   * @dataProvider validFileToArrayData
   * 
   * @param string $path
   * @param array $expected
   * @return void
   */
  public function testFileToArray(string $path, array $expected): void {
    $writer = $this->buildArrayParser();
    $this->assertSame($expected, $writer->fileToArray($path));
  }

  /**
   * @return void
   */
  public function testMissingFileToArray(): void {
    $writer = $this->buildArrayParser();
    $this->expectException(\Exception::class);
    $writer->fileToArray('foo.file');
  }

  /**
   * @return void
   */
  public function testBinaryFileToArray(): void {
    $writer = $this->buildArrayParser();
    $this->expectException(\Exception::class);
    $writer->fileToArray('./sphp/php/tests/files/image.gif');
  }

  abstract public function validToStringData(): iterable;

  /**
   * @dataProvider validToStringData
   * 
   * @param  mixed $data
   * @param  string $expected
   * @return void
   */
  public function testWrite($data, string $expected): void {
    $writer = $this->buildArrayParser();
    $this->assertSame(trim($expected), trim($writer->toString($data)));
  }

  abstract public function invalidToStringData(): iterable;

  /**
   * @dataProvider invalidToStringData
   * @param mixed $data
   * @param string $exceptionType
   * @return void
   */
  public function testInvalidWrite($data, string $exceptionType): void {
    $writer = $this->buildArrayParser();
    $this->expectException($exceptionType);
    $writer->toString($data);
  }

}
