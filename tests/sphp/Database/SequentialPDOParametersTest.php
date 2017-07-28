<?php

namespace Sphp\Database;

use Throwable;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

class SequentialPDOParametersTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var PDOParameters
   */
  protected $int;

  /**
   * @var PDOParameters
   */
  protected $string;

  protected function setUp() {
    $this->int = new SequentialPDOParameters();
    $this->string = new PDOParameters();
  }

  protected function tearDown() {
    unset($this->datastructure);
  }

  protected function getNumeric() {
    return new PDOParameters(PDOParameters::QUESTIONMARK);
  }

  /**
   * 
   * @return array
   */
  public function collectionData() {
    return [
        ['a', 'b'],
        [1, 'one'],
    ];
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testArrayAccess($offset, $value) {
    $instance = new SequentialPDOParameters();
    try {
      $instance[$offset] = $value;
      $this->assertTrue($instance->offsetExists($offset));
      $this->assertCount(1, $instance);
    } catch (Throwable $ex) {
      $this->assertTrue(!is_int($offset));
      $this->assertInstanceOf(InvalidArgumentException::class, $ex);
    }
  }

}
