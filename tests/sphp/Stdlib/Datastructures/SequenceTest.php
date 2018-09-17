<?php

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\OutOfBoundsException;

class SequenceTest extends TestCase {

  /**
   */
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
    $sequence->insert(5, 'b');
    $sequence->insert(0, 'a');
    $this->assertCount(2, $sequence);
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
   * @depends testJoining
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
}
