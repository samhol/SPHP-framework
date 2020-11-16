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
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\BadMethodCallException;

class ParserTest extends TestCase {

  /**
   * @return array
   */
  public function readers() {
    $map = [
        ['ini', Ini::class],
        ['json', Json::class],
        ['yaml', Yaml::class],
        ['yml', Yaml::class],
        ['yml', Yaml::class],
        ['markdown', Markdown::class],
        ['mdown', Markdown::class],
        ['mkdn', Markdown::class],
        ['md', Markdown::class],
        ['mkd', Markdown::class],
        ['mdwn', Markdown::class],
        ['mdtxt', Markdown::class],
        ['mdtext', Markdown::class],
        ['Rmd', Markdown::class],
        ['csv', Csv::class]
    ];
    return $map;
  }

  /**
   * @dataProvider readers
   * 
   * @param string $type
   * @param string $classType
   * @return void
   */
  public function testReaderExists(string $type, string $classType): void {
    $this->assertTrue(ParseFactory::readerExists($type));
    $this->assertInstanceOf($classType, ParseFactory::getReaderFor($type));
    $this->assertInstanceOf($classType, ParseFactory::$type());
  }

  /**
   * @return void
   */
  public function testGetReaderFailure(): void {
    $this->expectException(BadMethodCallException::class);
    ParseFactory::foo();
  }

  /**
   * @return array
   */
  public function filepathMap(): array {
    $map = [
        ['./sphp/php/tests/files/valid.md', '<h1 class="bar">test</h1>'],
        ['./sphp/php/tests/files/valid.yaml', ['foo' => 'bar']],
        ['./sphp/php/tests/files/valid.json', ['foo' => 'bar']],
        ['./sphp/php/tests/files/valid.ini', ['foo' => 'bar']],
    ];
    return $map;
  }

  /**
   * @dataProvider filepathMap
   * @param string $file
   * @param boolean $expected
   * @return void
   */
  public function testFromFile($file, $expected): void {
    $this->assertSame(ParseFactory::fromFile($file), $expected);
  }

  /**
   * @return void
   */
  public function testParsingFromInvalidFile(): void {
    $this->expectException(RuntimeException::class);
    ParseFactory::fromFile('foo.bar');
  }

  /**
   * @return void
   */
  public function testParsingFileWithoutExtension(): void {
    $this->expectException(InvalidArgumentException::class);
    ParseFactory::fromFile('./sphp/php/tests/files/test');
  }

  /**
   * @return void
   */
  public function testParsingFileWithUnknownExtension(): void {
    $this->expectException(InvalidArgumentException::class);
    ParseFactory::fromFile('./sphp/php/tests/files/test.foo');
  }

  /**
   * @dataProvider filepathMap
   * @param string $file
   * @param mixed $expected
   * @return void
   */
  public function testFromString(string $file, $expected): void {
    $raw = file_get_contents($file);
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $this->assertSame(ParseFactory::fromString($raw, $type), $expected);
  }

  /**
   * @return void
   */
  public function testParsingUnknownStringType(): void {
    $this->expectException(RuntimeException::class);
    ParseFactory::fromString('foo', 'bar');
  }

}
