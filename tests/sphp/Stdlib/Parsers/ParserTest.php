<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use RuntimeException;
use Sphp\Exceptions\BadMethodCallException;

class ParserTest extends \PHPUnit\Framework\TestCase {

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
        [$dir . 'test.md', '<h1 foo="bar">test</h1>'],
        [$dir . 'test.yaml', ['foo' => 'bar']],
        [$dir . 'test.json', ['foo' => 'bar']],
        [$dir . 'test.ini', ['foo' => 'bar']],
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
   * @param string $file
   * @param boolean $expected
   */
  public function testParsingFromInvalidFile() {
    $this->expectException(RuntimeException::class);
    Parser::fromFile('foo.bar');
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
