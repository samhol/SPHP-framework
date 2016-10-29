<?php

namespace Sphp\Data;

class CollectionTest extends \PHPUnit_Framework_TestCase {

  /**
   * @var Collection
   */
  protected $datastructure;

  protected function setUp() {
    $this->datastructure = new Collection();
  }

  protected function tearDown() {
    unset($this->datastructure);
  }

  /**
   * 
   * @return array
   */
  public function collectionData() {
    return [
        [range(-1000, 1000)],
        [[0]],
        [[null]],
        [[false]],
        [['']],
        [[
        'stdClass' => new \stdClass(),
        'null' => null,
        'false' => false,
        'true' => true,
        1 => 1,
        0 => 0,
        'string' => 'string',
        'empty string' => "",
        'zero string' => "0",
        "float" => 3.14]]
    ];
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testAppend(array $values) {
    $count = count($values);
    $offset = 0;
    foreach ($values as $value) {
      $this->datastructure->append($value);
      $this->assertTrue($this->datastructure->contains($value));
      $this->assertSame($this->datastructure->offsetGet($offset), $value);
      $offset++;
    }
    $this->assertCount($count, $this->datastructure);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testPrepend(array $values) {
    $count = count($values);
    $counter = 0;
    foreach ($values as $value) {
      $this->datastructure->prepend($value);
      $this->assertTrue($this->datastructure->contains($value));
      $this->assertSame($this->datastructure->offsetGet(0), $value);
      $this->assertCount(++$counter, $this->datastructure);
    }
    $this->assertCount($count, $this->datastructure);
  }

  /**
   * @dataProvider collectionData
   */
  public function testOffsetMethods(array $values) {
    $count = count($values);
    foreach ($values as $key => $value) {
      $this->datastructure->offsetSet($key, $value);
      $this->assertTrue($this->datastructure->offsetExists($key));
      $this->assertSame($this->datastructure->offsetGet($key), $value);
    }
    $this->assertCount($count, $this->datastructure);
    foreach ($values as $key => $value) {
      $this->datastructure->offsetUnset($key);
      $this->assertFalse($this->datastructure->offsetExists($key));
    }
    $this->assertCount(0, $this->datastructure);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function test(array $values) {
    $count = count($values);
    $counter = 0;
    foreach ($values as $value) {
      $this->datastructure->prepend($value);
      $this->assertTrue($this->datastructure->contains($value));
      $this->assertSame($this->datastructure->offsetGet(0), $value);
      $this->assertCount(++$counter, $this->datastructure);
    }
    $this->assertCount($count, $this->datastructure);
  }

}
