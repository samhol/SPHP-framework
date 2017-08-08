<?php

namespace Sphp\Database;

class PDOParametersTest extends \PHPUnit\Framework\TestCase {

  protected function setUp() {
    
  }

  protected function tearDown() {
    unset($this->datastructure);
  }

  protected function getNumeric() {
    return new SequentialParameters();
  }

  /**
   * 
   * @return array
   */
  public function numericallyIndexedCollectionData() {
    return [
        [
            [
                1 => 'b',
                3 => 3,
                2 => 'one'
            ]
        ],
    ];
  }

  /**
   * @dataProvider numericallyIndexedCollectionData
   * @param array $collection
   */
  public function testNumericArrayAccess($collection) {
    $instance = $this->getNumeric();
    $instance[] = 'first';
    $this->assertFalse($instance->offsetExists(0));
    $this->assertTrue($instance->offsetExists(1));
    $this->assertSame('first', $instance[1]);
    foreach ($collection as $offset => $value) {
      echo "\nSetting offset ($offset) with value '$value'";
      $instance[$offset] = $value;
      $this->assertTrue($instance->offsetExists($offset));
      $this->assertSame($value, $instance[$offset]);
    }
    $this->assertCount(count($collection), $instance);
  }

}
