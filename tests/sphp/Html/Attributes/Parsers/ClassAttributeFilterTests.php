<?php

namespace Sphp\Html\Attributes\Utils;

use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class ClassAttributeFilterTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var ClassAttributeUtils 
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new ClassAttributeUtils();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->filter = null;
  }

  /**
   * @return mixed[]
   */
  public function invalidAtomicData(): array {
    return [
        [null],
        [''],
        [1],
        [.1],
        [true],
        [false],
        [new \Sphp\Html\Container('class')],
        [' '],
        [' class '],
        ['  '],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [['class']],
    ];
  }

  /**
   * @dataProvider invalidAtomicData
   */
  public function testInvalidAtomicValueValidation($value) {
    $this->assertFalse($this->filter->isValidAtomicValue($value));
  }

  /**
   * @return string[]
   */
  public function validAtomicData(): array {
    return [
        ['class'],
        ['_'],
        ['__'],
        ['a'],
        ['z'],
        ['_a'],
        ['_1'],
        ['_-'],
    ];
  }

  /**
   * @dataProvider validAtomicData
   */
  public function testValidAtomicValueValidation($value) {
    $this->assertTrue($this->filter->isValidAtomicValue($value));
    $this->assertSame(true, $this->filter->isValidAtomicValue($value));
  }

  /**
   * @return string[]
   */
  public function parseableStringData(): array {
    return [
        ['a', ['a']],
        ['a ', ['a']],
        ["\na ", ['a']],
        ['a b', ['a', 'b']],
        ["a\nb", ['a', 'b']],
        ["  a\n b  ", ['a', 'b']],
    ];
  }

  /**
   * @dataProvider parseableStringData
   * @param string $value
   * @param array $result
   */
  public function testStringParsing(string $value, array $result) {
    $filtered = $this->filter->parseStringToArray($value);
    $this->assertSame($filtered, $result);
  }

  /**
   * 
   * @return string[]
   */
  public function validArrayData(): array {
    return [
        ['a', ['b', ['c', ['d']]]],
        [['_2a-', '_2', ['a2']], ['_z2a-', 'a', ['a']]],
        [['_-', '_a-', 'a__', '_-', '_a-', 'a__']],
        [['_-', '_a-', 'a__', '_-', '_a-', 'a__']],
    ];
  }

  /**
   * @dataProvider validArrayData
   *
   * @param string $value
   */
  public function testValidArrayFilterings($value) {
    $filtered = $this->filter->parse($value, true);
    $this->assertSame($this->filter->parse($value), $filtered);
    if (is_string($value)) {
      $this->assertContains($value, $filtered);
    } else {
      foreach (\Sphp\Stdlib\Arrays::flatten($value) as $v) {
        $this->assertContains($v, $filtered);
      }
    }
  }

  /**
   * @return string[]
   */
  public function invalidArrayData(): array {
    return [
        ['"', ['b', ['c', ['d']]]],
        [['_2a-', '_2', ['a2']], ['_z2a-', 'a', ['a']]],
        [['_-', '_a-', 'a__', '_-', '_a-', 'a__']],
        [['_-', '_a-', 'a__', '_-', '_a-', 'a__']],
    ];
  }

  /**
   * @dataProvider invalidArrayData
   *
   * @param string $value
   */
  public function testInvalidArrayFilterings($value) {
    $filtered = $this->filter->parse($value, true);
    $this->assertSame($this->filter->parse($value), $filtered);
    if (is_string($value)) {
      $this->assertContains($value, $filtered);
    } else {
      foreach (\Sphp\Stdlib\Arrays::flatten($value) as $v) {
        $this->assertContains($v, $filtered);
      }
    }
  }

}
