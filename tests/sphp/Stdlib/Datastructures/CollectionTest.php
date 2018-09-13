<?php

namespace Sphp\Stdlib\Datastructures;

class CollectionTest extends \Sphp\Tests\ArrayAccessIteratorCountableTestCase {

  /**
   * @var Collection
   */
  protected $collection;

  protected function setUp() {
    $this->collection = new Collection();
  }

  protected function tearDown() {
    unset($this->collection);
  }

  public function testMockArrayIterator() {
    $mock = \Mockery::mock(Collection::class);
    $items = array(
        null => 3,
        'zero' => 3,
        'one' => FALSE,
        'two' => 'good job',
        'three' => new \stdClass(),
        'four' => array(),
    );
    $this->mockArrayIterator($mock, $items);
    $this->assertTrue(isset($mock['zero']));
    $this->assertTrue(isset($mock['one']));
    $this->assertTrue(isset($mock['two']));
    $this->assertTrue(isset($mock['three']));
    $this->assertTrue(isset($mock['four']));
    $this->assertFalse(isset($mock['five']));
    $this->assertEquals(3, $mock['zero']);
    $this->assertEquals(FALSE, $mock['one']);
    $this->assertEquals('good job', $mock['two']);
    $this->assertInstanceOf('stdClass', $mock['three']);
    $this->assertEquals(array(), $mock['four']);
    $this->assertCount(6, $mock);
    // both cycles must pass
    for ($n = 0; $n < 2; ++$n) {
      $i = 0;
      reset($items);
      foreach ($mock as $key => $val) {
        if ($i >= 6) {
          $this->fail("Iterator overflow!");
        }
        $this->assertEquals(key($items), $key);
        $this->assertEquals(current($items), $val);
        next($items);
        ++$i;
      }
      $this->assertEquals(6, $i);
    }
  }

  /**
   * @return array
   */
  public function collectionData() {
    return [
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
    $this->assertTrue($this->collection->isEmpty());
    foreach ($values as $value) {
      $this->collection->append($value);
      $this->assertTrue($this->collection->contains($value));
      $this->assertSame($this->collection->offsetGet($offset), $value);
      $offset++;
    }
    $this->assertFalse($this->collection->isEmpty());
    $this->assertCount($count, $this->collection);
    $this->collection->clear();
    $this->assertSame($this->collection->isEmpty(), $this->collection->count() === 0);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testPrepend(array $values) {
    $count = count($values);
    $counter = 0;
    foreach ($values as $value) {
      $this->collection->prepend($value);
      $this->assertTrue($this->collection->contains($value));
      $this->assertSame($this->collection->offsetGet(0), $value);
      $this->assertCount(++$counter, $this->collection);
    }
    $this->assertCount($count, $this->collection);
  }

  /**
   * @dataProvider collectionData
   */
  public function testOffsetMethods(array $values) {
    $count = count($values);
    foreach ($values as $key => $value) {
      $this->collection->offsetSet($key, $value);
      $this->assertTrue($this->collection->offsetExists($key));
      $this->assertSame($this->collection->offsetGet($key), $value);
    }
    $this->assertCount($count, $this->collection);
    foreach ($values as $key => $value) {
      $this->collection->offsetUnset($key);
      $this->assertFalse($this->collection->offsetExists($key));
    }
    $this->assertCount(0, $this->collection);
  }

  public function testFilter() {
    $mod2 = function($n) {
      return($n % 2) === 0;
    };
    $collection = new Collection(['a' => 2, 'one' => 1, 6, 9]);
    $filtered = $collection->filter($mod2);
    foreach ($filtered as $key => $value) {
      $this->assertSame($collection[$key], $value);
      $this->assertTrue(($value % 2) === 0);
    }
  }

  public function testMap() {
    $cubed = function($n) {
      return($n * $n * $n);
    };
    $collection = new Collection(['a' => 2, 'one' => 1]);
    $cubedCollection = $collection->map($cubed);
    $this->assertSame($collection->count(), 2);
    $this->assertSame($cubedCollection->count(), 2);
    foreach ($collection as $key => $value) {
      $this->assertSame($cubed($value), $cubedCollection[$key]);
    }
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testRemove(array $values) {
    $this->collection->merge($values);
    $counter = count($values);
    foreach ($values as $value) {
      $this->collection->remove($value);
      $this->assertFalse($this->collection->contains($value));
      $this->assertCount(--$counter, $this->collection);
    }
    $this->assertCount(0, $this->collection);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testIterator(array $values) {
    $this->collection->merge($values);
    foreach ($this->collection as $key => $value) {
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
    $this->collection = new Collection();
    $this->collection->merge($values);
    foreach ($this->collection as $key => $value) {
      $this->assertSame($value, $values[$key]);
    }
    return $this->collection;
  }

}
