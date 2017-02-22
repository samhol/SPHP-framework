<?php

namespace Sphp\Stdlib\Datastructures;

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
  public function testRemove(array $values) {
    $this->datastructure->merge($values);
    $counter = count($values);
    foreach ($values as $value) {
      $this->datastructure->remove($value);
      $this->assertFalse($this->datastructure->contains($value));
      $this->assertCount(--$counter, $this->datastructure);
    }
    $this->assertCount(0, $this->datastructure);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testIterator(array $values) {
    $this->datastructure->merge($values);
    foreach ($this->datastructure as $key => $value) {
      $this->assertSame($value, $values[$key]);
    }
  }

  /**
   * 
   * @return array
   */
  public function filterData() {
    return [
        [
            [
                'stdClass' => new \stdClass(),
                'null' => null,
                'false' => false,
                'true' => true,
                1 => 1,
                0 => 0,
                'string' => 'string',
                'empty string' => '',
                'zero string' => '0',
                "float" => 3.14]
        ]
    ];
  }

  /**
   * @dataProvider filterData
   * @param array $values
   */
  public function testMerge(array $values) {
    $this->datastructure = new Collection();
    $this->datastructure->merge($values);
    foreach ($this->datastructure as $key => $value) {
      $this->assertSame($value, $values[$key]);
    }
    return $this->datastructure;
  }

  /**
   * @depends clone testMerge
   * @param Collection $collection
   */
  public function testFilter(Collection $collection) {
    //$this->datastructure->merge($values);
    $this->assertTrue($collection->contains(null));
    $removeNulls = function ($v) {
      return $v !== null;
    };
    $collection->filter($removeNulls);
    $this->assertFalse($collection->contains(null));
    $this->assertTrue($collection->contains('string'));
    $removeStrings = function ($v) {
      return !is_scalar($v);
    };
    $collection->filter($removeStrings);
    foreach($collection as $val){
      $this->assertFalse(is_scalar($val));
    }
    $this->assertFalse($collection->contains(null));
  }

}
