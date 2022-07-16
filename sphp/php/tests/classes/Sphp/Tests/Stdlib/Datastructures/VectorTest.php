<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Datastructures\Vector;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\UnderflowException;

class VectorTest extends TestCase {

  public function testInsertionsIntoNegativePosition(): void {
    $vector = new Vector();
    $this->expectException(OutOfBoundsException::class);
    $vector->insert(-1, 'b');
  }

  public function testInsertionsIntoTooBigPosition(): void {
    $vector = new Vector( );
    $this->assertTrue($vector->isEmpty());
    $this->expectException(OutOfBoundsException::class);
    $vector->insert(10, 'foo');
  }

  public function testDefaultConstructor(): Vector {
    $vector = new Vector();
    $this->assertTrue($vector->isEmpty());
    $this->assertFalse($vector->indexExists(0));
    $this->assertFalse($vector->indexExists(9));
    $this->assertFalse($vector->indexExists(10));
    $this->assertSame(10, $vector->getCapacity());
    $this->assertSame(0, $vector->count());
    $this->assertFalse($vector->contains(null));
    return $vector;
  }

  /**
   * 
   * @return array
   */
  public function sequenceData(): iterable {
    yield range('a', 'd');
    yield [[0], [], null, new \stdClass()];
  }

  /**
   * @dataProvider sequenceData
   * 
   * @param  mixed $value
   * @return void
   */
  public function testConstructor(mixed ...$value): void {
    $vector = new Vector(...$value);
    $this->assertSame($count = count($value), $vector->getCapacity());
    $this->assertSame($count, $vector->count());
    $this->assertFalse($vector->isEmpty());
    foreach ($value as $index => $val) {
      $this->assertSame($val, $vector->get($index));
    }
  }

  public function testInsert(): void {
    $vector = new Vector(1, 2, 3, 4);
    $this->assertSame($vector->count(), $vector->getCapacity());
    for ($index = 0; $index < $vector->count(); $index++) {
      $this->assertSame($vector, $vector->insert($index, $a = new \stdClass()));
      $this->assertSame($a, $vector->get($index));
    }
    $this->expectException(OutOfBoundsException::class);
    $vector->insert(4, 'foo-bar');
  }

  public function testGetting(): void {
    $vector = new Vector($a = new \stdClass(), $b = new \stdClass());
    $this->assertSame($a, $vector->get(0));
    $this->assertSame($b, $vector->get(1));
    $this->expectException(OutOfBoundsException::class);
    $vector->get(2);
  }

  public function testSetCapacity(): void {
    $vector = new Vector(1, 2, 3, 4);
    $this->assertSame($vector, $vector->setCapacity(10));
    $this->assertSame(10, $vector->getCapacity());
    $this->assertNull($vector->get(4));
    $this->assertNull($vector->get(9));
    $this->assertSame($vector, $vector->insert(9, 'foo-bar'));
    $this->assertSame('foo-bar', $vector->get(9));
    $this->expectException(OutOfBoundsException::class);
    $vector->setCapacity(9);
  }

  /**
   * @dataProvider sequenceData
   *
   * @param  mixed ... $data
   * @return void
   */
  public function testToArrayAndGetIterator(mixed ...$data): void {
    $vector = new Vector(...$data);
    $arr = $vector->toArray();
    $this->assertSame($data, $arr);
    $it_arr = iterator_to_array($vector);
    $this->assertSame($data, $it_arr);
    foreach ($arr as $key => $value) {
      $this->assertSame($value, $vector->get($key));
      $this->assertTrue($vector->indexExists($key));
    }
    foreach ($vector as $key => $value) {
      $this->assertSame($value, $vector->get($key));
      $this->assertSame($value, $arr[$key]);
    }
  }

  public function testPushAndPop(): void {
    $vector = new Vector(new \stdClass(), 2);
    $this->assertSame($vector, $vector->push('a', 'b'));
    $this->assertSame(4, $vector->getCapacity());
    $this->assertSame('a', $vector->get(2));
    $this->assertSame('b', $vector->get(3));
    $i = $vector->count();
    while ($i > 0) {
      $i--;
      $lastValue = $vector->get($i);
      $this->assertSame($lastValue, $vector->pop());
      $this->assertNull($vector->get($i));
    }
    $this->expectException(UnderflowException::class);
    $vector->pop();
  }

  /**
   * @return void
   */
  public function testContains(): void {
    $vector = new Vector($a = new \stdClass(), $b = new \stdClass());
    $this->assertTrue($vector->contains($a));
    $this->assertTrue($vector->contains($b));
    $this->assertSame($vector, $vector->push($b));
    $this->assertTrue($vector->contains($b));
    $this->assertSame($b, $vector->pop());
    $this->assertTrue($vector->contains($b));
    $this->assertSame($b, $vector->pop());
    $this->assertFalse($vector->contains($b));
    $this->assertFalse($vector->contains($c = new \stdClass()));
    $this->assertSame($vector, $vector->push($c));
    $this->assertTrue($vector->contains($c));
  }

  public function testRemove(): void {
    $vector = new Vector($a = new \stdClass(), $b = new \stdClass());
    $this->assertTrue($vector->contains($a));
    $this->assertTrue($vector->contains($b));
    $this->assertSame($a, $vector->remove(0));
    $this->assertNull($vector->get(0));
    $this->assertFalse($vector->contains($a));
    $this->assertSame($b, $vector->remove(1));
    $this->assertFalse($vector->contains($b));
    $this->assertNull($vector->get(1));
    $this->assertSame(2, $vector->getCapacity());
    $this->expectException(OutOfBoundsException::class);
    $vector->remove(2);
  }

  public function testReversed(): void {
    $vector = new Vector($a = new \stdClass(), $b = new \stdClass());
    $vector->setCapacity(3);
    $reversed = $vector->reversed();
    $this->assertSame($reversed->getCapacity(), $vector->getCapacity());
    $this->assertSame($b, $reversed->get(0));
    $this->assertSame($a, $reversed->get(1));
  }

  public function stringableSequences(): iterable {
    yield range(1, 3);
    yield range('a', 'c');
  }

  /**
   * @dataProvider stringableSequences
   * 
   * @param  mixed ... $values
   * @return void
   */
  public function testJoining(mixed ... $values): void {
    $vector = new Vector(...$values);
    $this->assertSame(implode(',', $values), $vector->join(','));
    $this->assertSame(implode('', $values), $vector->join());
  }

}
