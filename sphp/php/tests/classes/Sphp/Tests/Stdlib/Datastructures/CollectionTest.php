<?php

declare(strict_types=1);

namespace Sphp\Tests\Stdlib\Datastructures;

use Sphp\Stdlib\Datastructures\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase {

  public function testDefaultConstructor(): void {
    $collection = new Collection();
    $this->assertCount(0, $collection);
    $this->assertCount(0, $collection->toArray());
    $this->assertTrue(0 === $collection->count());
    $this->assertTrue($collection->toQueue()->isEmpty());
    $this->assertTrue($collection->toStack()->isEmpty());
  }

  public function constructorItems(): iterable {
    yield [range(0, 10)];
    yield [[1, 3, new \ArrayIterator(range(0, 10))]];
  }

  /**
   * @dataProvider constructorItems
   * @param  iterable $items
   * @return void
   */
  public function testConstructorWithParameters(iterable $items): void {
    $collection = new Collection($items);
    $this->assertCount(count($items), $collection);
    $this->assertCount(count($items), $collection->toArray());
    $this->assertTrue(count($items) === $collection->count());
    $this->assertFalse($collection->toQueue()->isEmpty());
    $this->assertFalse($collection->toStack()->isEmpty());
  }

  /**
   * @dataProvider constructorItems
   * @param  iterable $items
   * @return void
   */
  public function testClone(): void {
    $collection = new Collection();
    $obj1 = new \stdClass();
    $collection->append($obj1);
    $collection->append($obj1);
    $cloned = clone $collection;
    $this->assertNotSame($cloned, $collection);
    $this->assertFalse($cloned->contains($obj1));
    $this->assertCount(2, $cloned);
  }

  public function diffData(): array {
    $data = [];
    $data[] = [range(0, 10), range(3, 6)];
    $data[] = [new \ArrayIterator(range(0, 10)), new \ArrayIterator(range(3, 6))];
    return $data;
  }

  /**
   * @dataProvider diffData
   * @param iterable $items
   * @param type $comp
   */
  public function testDiff(iterable $items, iterable $comp) {
    $collection = new Collection($items);
    $diff = $collection->diff($comp);
    if (!is_array($items)) {
      $items = iterator_to_array($items);
    }
    if (!is_array($comp)) {
      $comp = iterator_to_array($comp);
    }
    $expected = array_diff($items, $comp);
    $this->assertEquals($diff->toArray(), $expected);
  }

  public function testMockArrayIterator() {
    $items = array(
        null => 3,
        'zero' => 3,
        'one' => FALSE,
        'two' => 'good job',
        'three' => new \stdClass(),
        'four' => array(),
    );
    $mock = new Collection($items);

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
   * @return Collection
   */
  public function testAppendAndPrepend(): Collection {
    $c = new Collection();
    $this->assertFalse($c->contains('a'));
    $c->append('a');
    $this->assertSame('a', $c[0]);
    $this->assertTrue($c->contains('a'));
    $c->prepend('p');
    $this->assertSame('p', $c[0]);
    $this->assertSame('a', $c[1]);
    $this->assertTrue($c->contains('p'));
    $this->assertCount(2, $c);
    $this->assertFalse($c->isEmpty());
    $c->prepend(null);
    $this->assertTrue($c->contains(null));
    $this->assertSame(null, $c[0]);
    return $c;
  }

  /**
   * @depends testAppendAndPrepend
   * @param  Collection $c
   * @return Collection
   */
  public function testTraversing(Collection $c): Collection {
    $arr = $c->toArray();
    $stack = $c->toStack();
    $queue = $c->toQueue();
    foreach ($arr as $q) {
      $this->assertSame($q, $queue->dequeue());
    }
    $this->assertTrue($queue->isEmpty());
    $reversed = array_reverse($arr);
    foreach ($reversed as $value) {
      $this->assertSame($value, $stack->pop());
    }
    $this->assertTrue($stack->isEmpty());
    return $c;
  }

  /**
   * @depends testTraversing
   * @param  Collection $c
   * @return Collection
   */
  public function testClearing(Collection $c): Collection {
    $this->assertFalse($c->isEmpty());
    $this->assertSame($c, $c->clear());
    $this->assertTrue($c->isEmpty());
    $this->assertCount(0, $c);
    return $c;
  }

  /**
   * @depends testTraversing
   * @param Collection $c
   */
  public function testOffsetMethods(Collection $c) {
    $c[] = 'zero';
    $this->assertTrue(isset($c[0]));
    $this->assertSame('zero', $c[0]);
    unset($c[0]);
    $arr = [
        'stdClass' => new \stdClass(),
        'null' => null,
        'false' => false,
        1 => 1,
        0 => 3.14,
        'string' => 'string'
    ];
    foreach ($arr as $key => $value) {
      $this->assertFalse(isset($c[$key]));
      $c[$key] = $value;
      $this->assertTrue(isset($c[$key]));
      $this->assertSame($value, $c[$key]);
    }
    $this->assertCount(count($arr), $c);
    foreach ($arr as $key => $value) {
      unset($c[$key]);
      $this->assertFalse(isset($c[$key]));
    }
    $this->assertCount(0, $c);
  }

  public function testFilter() {
    $mod2 = function ($n) {
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
    $cubed = function ($n) {
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
  public function testRemove(array $values): void {
    $collection = new Collection();
    $collection->merge($values);
    $counter = count($values);
    foreach ($values as $value) {
      $collection->remove($value);
      $this->assertFalse($collection->contains($value));
      $this->assertCount(--$counter, $collection);
    }
    $this->assertCount(0, $collection);
  }

  /**
   * @dataProvider collectionData
   * @param array $values
   */
  public function testIterator(array $values): void {
    $collection = new Collection($values);
    foreach ($collection as $key => $value) {
      $this->assertSame($value, $values[$key]);
    }
  }

  /**
   * @dataProvider collectionData
   *
   * @param  array $values
   * @return void
   */
  public function testMerge(array $values): void {
    $collection = new Collection();
    $collection->merge($values);
    foreach ($collection as $key => $value) {
      $this->assertSame($values[$key], $value);
    }
  }

  public function testKeys(): void {
    $array = range('a', 'd');
    $arrayKeys = array_keys($array);
    $indexed = new Collection($array);
    $this->assertEquals($arrayKeys, $indexed->keys());
    $this->assertEquals($array, $indexed->toArray());
  }

}
