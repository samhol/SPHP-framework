<?php

namespace Sphp\Html\Attributes\Filters;

use Sphp\Html\Attributes\PropertyAttribute;

class PropertyAttributeTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var 
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new StyleAttributeParser();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->filter = null;
  }

  /**
   * 
   * @return string[]
   */
  public function lockMethodData() {
    return [
        ["p:v;"],
        ["p1:v1;p2:v2;"]
    ];
  }

  /**
   * 
   * @return string[]
   */
  public function scalarData() {
    return [
        ["", false, false],
        [" ", false, false],
        [true, false, false],
        [false, false, false],
        ["p1:v1; p2:v2;", "p1:v1;p2:v2;", true],
        [" value2 ", false, false],
        [0, false, false],
        [-1, false, false],
        [1, false, false],
        [0b100, false, false]
    ];
  }

  /**
   * @return array
   */
  public function rawArrayData(): array {
    return [
        [['a' => 'b'], ['a' => 'b']],
        [['a' => 0], ['a' => 0]],
    ];
  }

  /**
   * 
   * @covers StyleAttributeParser::parse()
   * @dataProvider rawArrayData
   */
  public function testArrayParsing(array $value, array $expected) {
    $this->assertEquals($this->filter->parse($value), $expected);
  }

  /**
   * @return array
   */
  public function rawStringData(): array {
    return [
        ['', []],
        [' ', []],
        [':;', []],
        [' p ', []],
        ['p: v;', ['p' => 'v']],
        ["color:blue;text-align:center",
            [
                'color' => 'blue',
                'text-align' => 'center'
            ]
        ]
    ];
  }

  /**
   * 
   * @covers StyleAttributeParser::parse()
   * @dataProvider rawStringData
   */
  public function testParsing(string $value, array $expected) {
    $this->assertEquals($this->filter->parse($value), $expected);
  }

}
