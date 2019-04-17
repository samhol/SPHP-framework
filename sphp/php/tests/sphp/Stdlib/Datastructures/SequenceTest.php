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

  public function testInvalidInsertions() {
    $sequence = new Sequence();
    $this->expectException(OutOfBoundsException::class);
    $sequence->insert(-5, 'b');
  }

  /**
   * @return Sequence
   */
  public function testInsertOrdering(): Sequence {
    $sequence = new Sequence();
    $this->assertTrue($sequence->isEmpty());
    $this->assertSame(0, $sequence->count());
    $sequence->insert(5, 'b');
    $this->assertFalse($sequence->isEmpty());
    $sequence->insert(0, 'a');
    $this->assertCount(2, $sequence);
    $this->assertSame(2, $sequence->count());
    $this->assertSame($sequence->toArray(), [0 => 'a', 5 => 'b']);
    return $sequence;
  }

  /**
   * @depends testInsertOrdering
   * @param  Sequence $sequence
   * @return Sequence
   */
  public function testPushing(Sequence $sequence): Sequence {
    $sequence->push('c', 'd');
    $this->assertCount(4, $sequence);
    $this->assertSame($sequence->toArray(), [0 => 'a', 5 => 'b', 'c', 'd']);
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
