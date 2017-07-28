<?php

namespace Sphp\Database;

use Throwable;
use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;

class PDOParametersTest extends \PHPUnit_Framework_TestCase {

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
    $instance = new PDOParameters(PDOParameters::QUESTIONMARK);
    try {
      $instance[$offset] = $value;
      $this->assertTrue($instance->offsetExists($offset));
      $this->assertCount(1, $instance);
    } catch (Throwable $ex) {
      $this->assertInstanceOf(InvalidArgumentException::class, $ex);
    }
  }

}
