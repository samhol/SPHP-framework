<?php

namespace Sphp\Html\Attributes\Filters;

use Sphp\Html\Attributes\MultiValueAttribute;

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
    echo "\nsetUp:\n";
    $this->filter = new ClassAttributeFilter();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    echo "\ntearDown:\n";
    $this->filter = null;
  }

  /**
   * @return string[]
   */
  public function emptyData(): array {
    return [
        [''],
        [' '],
        ['  '],
        ["\n"],
        ["\n\t\r"],
        ["\t"],
        [" \r \n \t "],
        [['', ['']]],
    ];
  }

  /**
   * @dataProvider emptyData
   */
  public function testEmptyData($value) {
    $filtered = $this->filter->filter($value);
    $this->assertSame([], $filtered);
    $this->assertEquals(count($filtered), 0);
  }

  /**
   * 
   * @return string[]
   */
  public function stringData(): array {
    return [
        [' a ', ['a']],
        ['a', ['a']],
        ['a b c', ['a', 'b', 'c']],
    ];
  }

  /**
   * @dataProvider stringData
   *
   * @param string $value
   * @param string[] $expected
   */
  public function testStringParsing(string $value, array $expected) {
    $this->assertSame($this->filter->filter($value), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function arrayData(): array {
    return [
        [[' a ', ['a']], ['a']],
        [['a c', ['b']], ['a', 'c', 'b']],
        [['a b c'], ['a', 'b', 'c']],
    ];
  }

  /**
   * @dataProvider arrayData
   *
   * @param string $value
   * @param string[] $expected
   */
  public function testArrayFiltering(array $value, array $expected) {
    $this->assertSame($this->filter->filter($value), $expected);
  }

  /**
   * 
   * @return string[]
   */
  public function objectData(): array {
    return [
        [(new MultiValueAttribute('foo'))->add('k', 'l'), ['k', 'l']],
    ];
  }

  /**
   * @dataProvider arrayData
   *
   * @param string $value
   * @param string[] $expected
   */
  public function testObjectFiltering(array $value, array $expected) {
    $this->assertSame($this->filter->filter($value), $expected);
  }

}
