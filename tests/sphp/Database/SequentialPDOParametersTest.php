<?php

namespace Sphp\Database;

use Sphp\Exceptions\InvalidArgumentException;

class SequentialParametersTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var SequentialParameters
   */
  protected $int;

  protected function setUp() {
    $this->int = new SequentialParameters();
  }

  protected function tearDown() {
    unset($this->int);
  }

  /**
   * 
   * @return array
   */
  public function correctData() {
    return [
        [2, 'b'],
        [1, 'one'],
        [3, true],
    ];
  }

  /**
   * 
   * @param int $offset
   * @param mixed $value
   */
  protected function validNameValuePair($offset, $value) {
    $this->assertTrue($this->int->offsetExists($offset));
    $this->assertTrue(isset($this->int[$offset]));
    $this->assertSame($value, $this->int[$offset]);
  }

  /**
   * @covers SequentialParameters::offsetExists
   */
  public function testArrayAccessAsPush() {
    $this->int[] = 'pushed';
    $this->validNameValuePair(1, 'pushed');
    $this->assertCount(1, $this->int);
  }

  /**
   * @dataProvider correctData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testArrayAccess($offset, $value) {
    $this->int[$offset] = $value;
    $this->validNameValuePair($offset, $value);
    $this->assertCount(1, $this->int);
  }

  /**
   * @return array
   */
  public function incorrectData(): array {
    return [
        [0, 'b'],
        [-1, 'foo'],
        ['1', 'foo'],
        ['a', 'foo']
    ];
  }

  /**
   * @dataProvider incorrectData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testIncorrectOffsetSet($offset, $value) {
    $this->expectException(InvalidArgumentException::class);
    $this->int[$offset] = $value;
  }

  /**
   * @return array
   */
  public function paramData(): array {
    return [
        [range('a', 'f')],
    ];
  }

  /**
   * @dataProvider paramData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testMerge(array $params) {
    if (array_key_exists(0, $params)) {
      unset($params[0]);
    }
    $this->int->mergeParams($params);
    foreach ($params as $index => $value) {
      $this->validNameValuePair($index, $value);
    }
    $this->assertCount(count($params), $this->int);
  }

  /**
   * @dataProvider paramData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testAppend(array $params) {
    $this->int->appendParams($params);

    $this->assertCount(count($params), $this->int);
  }

}
