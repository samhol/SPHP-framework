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
   */
  public function testReaderExists(string $type, string $classType) {
    $this->assertTrue(Parser::readerExists($type));
    $this->assertInstanceOf($classType, Parser::getReaderFor($type));
    $this->assertInstanceOf($classType, Parser::$type());
  }

  public function testGetReaderFailure() {

    $this->expectException(BadMethodCallException::class);
    Parser::foo();
  }

  /**
   * @return array
   */
  public function filepathMap(): array {
    $dir = __DIR__ . '/files/';
    $map = [
        ['./tests/files/test.md', '<h1 foo="bar">test</h1>'],
        ['./tests/files/test.yaml', ['foo' => 'bar']],
        ['./tests/files/test.json', ['foo' => 'bar']],
        ['./tests/files/test.ini', ['foo' => 'bar']],
    ];
    return $map;
  }

  /**
   * @dataProvider filepathMap
   * @param string $file
   * @param boolean $expected
   */
  public function testFromFile($file, $expected) {
    $this->assertSame(Parser::fromFile($file), $expected);
  }

  /**
   * @expectedException RuntimeException
   */
  public function testParsingFromInvalidFile() {
    Parser::fromFile('foo.bar');
  }

  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testParsingFileWithoutExtension() {
    Parser::fromFile('./tests/files/test');
  }

  /**
   * @expectedException \Sphp\Exceptions\InvalidArgumentException
   */
  public function testParsingFileWithUnknownExtension() {
    Parser::fromFile('./tests/files/test.foo');
  }

  /**
   * @dataProvider filepathMap
   * @param string $file
   * @param mixed $expected
   */
  public function testFromString(string $file, $expected) {
    $raw = file_get_contents($file);
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $this->assertSame(Parser::fromString($raw, $type), $expected);
  }

  public function testParsingUnknownStringType() {
    $this->expectException(RuntimeException::class);
    Parser::fromString('foo', 'bar');
  }

}
