<?php

namespace Sphp\Stdlib;

use Exception;
use RuntimeException;

class ParserTest extends \PHPUnit\Framework\TestCase {

  /**
   * @return array
   */
  public function typeMap() {
    $map = [
        ['ini', true],
        ['json', true],
        ['yaml', true],
        ['yml', true],
        ['yml', true],
        ['markdown', true],
        ['mdown', true],
        ['mkdn', true],
        ['md', true],
        ['mkd', true],
        ['mdwn', true],
        ['mdtxt', true],
        ['mdtext', true],
        ['text', true],
        ['Rmd', true],
        [1, false],
        ['foo', false]
    ];
    return $map;
  }

  /**
   * @dataProvider typeMap
   * @param string $type
   * @param boolean $expected
   */
  public function testReaderExists($type, $expected) {
    $this->assertSame(Parser::readerExists($type), $expected);
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
   * @dataProvider filepathMap
   * @param string $file
   * @param mixed $expected
   */
  public function testFromString(string $file, $expected) {
    $raw = file_get_contents($file);
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $this->assertSame(Parser::fromString($raw, $type), $expected);
  }

  /**
   * @dataProvider filepathMap
   * @param string $file
   * @param boolean $expected
   */
  public function testExceptions($file, $expected) {
    $this->expectException(RuntimeException::class);
    Parser::fromFile('foo.md');
  }

}
