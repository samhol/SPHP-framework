<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\OutOfBoundsException;
use Sphp\Exceptions\UnderflowException;

class SequenceTest extends TestCase {

  public function testInsertionsIntoNegativePosition(): void {
    $sequence = new Sequence();
    $this->expectException(OutOfBoundsException::class);
    $sequence->insert(-5, 'b');
  }

  public function testInsertionsIntoTooBigPosition(): void {
    $sequence = new Sequence(5);
    $this->expectException(OutOfBoundsException::class);
    $sequence->insert(6, 'foo');
  }

  public function testDefaultConstructor(): Sequence {
    $sequence = new Sequence();
    $this->assertTrue($sequence->isEmpty());
    $this->assertSame(0, $sequence->count());
    return $sequence;
  }

  /**
   * @depends testDefaultConstructor
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testInsertOrdering(Sequence $sequence): Sequence {
    $array = [
        5 => 'c',
        0 => 'a',
        2 => 'b',
        100 => 'd',
    ];
    $count = 0;
    foreach ($array as $index => $value) {
      $sequence->insert($index, $value);
      $this->assertTrue($sequence->contains($value));
      $this->assertTrue($sequence->exists($index));
      $this->assertFalse($sequence->isEmpty());
      $this->assertCount( ++$count, $sequence);
    }
    $traversal = [];
    foreach ($sequence as $index => $value) {
      $traversal[$index] = $value;
    }
    ksort($array);
    $this->assertSame($array, $traversal);
    $this->assertSame($array, $sequence->toArray());
    return $sequence;
  }

  /**
   * @depends testInsertOrdering
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testPushing(Sequence $sequence): Sequence {
    $this->assertSame($sequence, $sequence->clear());
    $sequence->insert(50, 'foo');
    $this->assertSame(51, $sequence->push('bar'));
    $this->assertTrue($sequence->exists(51));
    $this->assertTrue($sequence->contains('bar'));
    $this->assertSame(52, $sequence->push('baz'));
    $this->assertTrue($sequence->exists(52));
    $this->assertTrue($sequence->contains('baz'));
    $this->assertCount(3, $sequence);
    //$this->assertCount($count, $this->sequence);
    return $sequence;
  }

  /**
   * 
   * @return array
   */
  public function sequences() {
    return [
        [[2 => 'b', 1 => 'a'], ',', 'a,b'],
        [[0]],
    ];
  }

  /**
   * @depends testPushing
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testJoining(Sequence $sequence): Sequence {
    $this->assertSame(implode(',', $sequence->toArray()), $sequence->join(','));
    $this->assertSame(implode($sequence->toArray()), $sequence->join());
    return $sequence;
  }

  /**
   * @depends testJoining
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testUnsetting(Sequence $sequence): Sequence {
    $class = new \stdClass();
    $sequence->insert(100, $class);
    $this->assertTrue($sequence->contains($class));
    $this->assertFalse($sequence->contains(new \stdClass()));
    $sequence->remove(100);
    $this->assertFalse($sequence->contains($class));
    return $sequence;
  }

  /**
   */
  public function testClearing() {
    $sequence = new Sequence();
    $class = new \stdClass();
    $sequence->insert(100, $class);
    $sequence->insert(2, $class);
    $sequence->clear();
    $this->assertTrue($sequence->isEmpty());
    $this->assertSame(0, $sequence->count());
  }

  /**
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testInvalidUnsetting() {
    $sequence = new Sequence();
    $class = new \stdClass();
    $sequence->insert(100, $class);
    $this->assertTrue($sequence->contains($class));
    $this->expectException(OutOfBoundsException::class);
    $sequence->remove(101);
  }

  public function testPopping() {
    $sequence = new Sequence();
    $sequence->insert(0, 'zero');
    $sequence->insert(10, 'ten');
    $sequence->insert(5, 'five');
    $this->assertSame('ten', $sequence->pop());
    $this->assertSame('five', $sequence->pop());
    $this->assertSame('zero', $sequence->pop());
    $this->expectException(UnderflowException::class);
    $sequence->pop();
  }

}
