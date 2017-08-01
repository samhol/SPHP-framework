<?php

namespace Sphp\Database;

use Throwable;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;
use Exception;

class SequentialPDOParametersTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var AbstractPDOParameters
   */
  protected $int;

  /**
   * @var AbstractPDOParameters
   */
  protected $string;

  protected function setUp() {
    $this->int = new SequentialPDOParameters();
    $this->string = new AbstractPDOParameters();
  }

  protected function tearDown() {
    unset($this->datastructure);
  }

  protected function getNumeric() {
    return new AbstractPDOParameters(AbstractPDOParameters::QUESTIONMARK);
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
   * @dataProvider correctData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testArrayAccess($offset, $value) {
    $instance = new SequentialPDOParameters();
    $instance[$offset] = $value;
    $this->assertTrue($instance->offsetExists($offset));
    $this->assertCount(1, $instance);
  }

  /**
   * @return array
   */
  public function incorrectData(): array {
    return [
        [0, 'b'],
        [null, 'foo'],
        [-1, 'foo'],
        ['1', 'foo'],
        ['a', 'foo'],
        ['::foobar', 'foo'],
        [':foo', 'foo'],
    ];
  }

  /**
   * @dataProvider incorrectData
   * @param mixed $offset
   * @param mixed $value
   */
  public function testIncorrectInsert($offset, $value) {
    $instance = new SequentialPDOParameters();
    $this->expectException(InvalidArgumentException::class);
    $instance[$offset] = $value;
  }
}
