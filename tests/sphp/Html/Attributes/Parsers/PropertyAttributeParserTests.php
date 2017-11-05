<?php

namespace Sphp\Html\Attributes\Utils;

use Sphp\Html\Attributes\PropertyAttribute;

class PropertyAttributeTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var PropertyAttributeUtils
   */
  protected $utils;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->utils = new PropertyAttributeUtils();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->utils = null;
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
        [[' a ' => ' b '], ['a' => 'b']],
        [[" \na" => 'b '], ['a' => 'b']],
        [['a' => 0], ['a' => 0]],
    ];
  }

  /**
   * 
   * @covers StyleAttributeParser::parse()
   * @dataProvider rawArrayData
   */
  public function testArrayParsing(array $value, array $expected) {
    $this->assertEquals($this->utils->parse($value, true), $expected);
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
        ['a: b;', ['a' => 'b']],
        [' a : b ;', ['a' => 'b']],
        ["a:b;b:c",
            [
                'a' => 'b',
                'b' => 'c'
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
    $this->assertEquals($this->utils->parse($value), $expected);
  }

}
