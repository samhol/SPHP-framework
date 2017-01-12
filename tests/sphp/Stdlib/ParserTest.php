<?php

namespace Sphp\Stdlib;

class ParserTest extends \PHPUnit_Framework_TestCase {

  /**
   * 
   * @return array
   */
  public function typeMap() {
    $map = [
        ['php', true],
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
        [null, false],
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
   * 
   * @return array
   */
  public function filepathMap() {
    $dir = __DIR__ . '\files\\';
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

}
