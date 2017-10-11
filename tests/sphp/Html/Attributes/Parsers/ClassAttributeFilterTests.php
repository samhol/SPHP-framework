<?php

namespace Sphp\Html\Attributes\Utils;

use Sphp\Html\Attributes\MultiValueAttribute;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

class ClassAttributeFilterTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var ClassAttributeFilter 
   */
  protected $filter;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->filter = new ClassAttributeFilter();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    $this->filter = null;
  }

  /**
   * @return string[]
   */
  public function invalidData(): array {
    return [
        [null],
        [''],
        [1],
        [true],
        [false],
        [' '],
        ['  '],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [['2', ['']]],
    ];
  }

  /**
   * @dataProvider invalidData
   */
  public function testInvalidData($value) {
    $this->assertFalse($this->filter->isValidAtomicValue($value));
    $this->expectException(InvalidAttributeException::class);
    $this->filter->filter($value, true);
  }

  /**
   * 
   * @return string[]
   */
  public function validStringData(): array {
    return [
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
   * @dataProvider validStringData
   *
   * @param string $value
   */
  public function testValidStringFilterings($value) {
    $filtered = $this->filter->filter($value, true);
    $this->assertSame($this->filter->filter($value), $filtered);
    $this->assertContains($value, $filtered);
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
   * @dataProvider validData
   *
   * @param string $value
   */
  public function testValidArrayFilterings($value) {
    $filtered = $this->filter->filter($value, true);
    $this->assertSame($this->filter->filter($value), $filtered);
    if (is_string($value)) {
      $this->assertContains($value, $filtered);
    } else {
      foreach (\Sphp\Stdlib\Arrays::flatten($value) as $v) {
        $this->assertContains($v, $filtered);
      }
    }
  }

  /**
   * @return object[]
   */
  public function validObjectData(): array {
    return [
        [(new \Sphp\Stdlib\MbString('foo')), ['foo']],
    ];
  }

  /**
   * @dataProvider validObjectData
   * @param object $value
   * @param string[] $expected
   */
  public function testValidObjectFiltering($value, array $expected) {
    $this->assertSame($this->filter->filter($value), $expected);
  }

  /**
   * @return object[]
   */
  public function invalidObjectData(): array {
    return [
        [new \Sphp\Stdlib\StopWatch()],
        [new \stdClass()],
    ];
  }

  /**
   * @dataProvider invalidObjectData
   * @param object $value
   */
  public function testInvalidObjectFiltering($value) {
    $this->expectException(InvalidAttributeException::class);
    $this->filter->filter($value, true);
  }

}
