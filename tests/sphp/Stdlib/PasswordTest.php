<?php

namespace Sphp\Stdlib;

class FactoryTest extends \PHPUnit_Framework_TestCase {

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
        ['Rmd', true]
    ];
    return $map;
  }

  /**
   * @dataProvider typeMap
   * @param string $type
   * @param boolean $expected
   */
  public function testReaderExists($type, $expected) {
    $this->assertSame(Factory::readerExists($type), $expected);
  }

}
