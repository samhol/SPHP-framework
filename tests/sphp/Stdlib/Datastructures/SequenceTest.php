<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Exceptions\OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class SequenceTest extends TestCase {

  /**
   * @var Sequence
   */
  protected $sequence;

  protected function setUp() {
    $this->sequence = new Sequence();
  }

  protected function tearDown() {
    unset($this->sequence);
  }

  /**
   */
  public function testInvalidInsertions() {
    $sequence = new Sequence();
    $this->expectException(OutOfBoundsException::class);
    $sequence->insert(-5, 'b');
  }

  /**
   * 
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
   * @param Sequence $sequence
   */
  public function testPushing(Sequence $sequence) {
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
   * @param Sequence $sequence
   */
  public function testJoining(Sequence $sequence) {
    $expected = implode(',', $sequence->toArray());
    echo $sequence->join(',');
    $this->assertSame($expected, $sequence->join(','));
  }

}
