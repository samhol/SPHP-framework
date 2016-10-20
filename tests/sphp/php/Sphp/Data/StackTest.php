<?php

namespace Sphp\Data;

class StackTest extends \PHPUnit_Framework_TestCase {

  /**
   * 
   * @return Stack
   */
  public function createStack() {
    $stack = new Stack();
    return $stack;
  }

  /**
   * @depends createStack
   */
  public function testEmpty(StackInterface $stack) {
    $this->assertEquals(0, count($stack));
    $this->assertEquals(0, $stack->count());
    return $stack;
  }

  /**
   * @depends testEmpty
   */
  public function testPush(StackInterface $stack) {
    $stack->push('foo');
    $this->assertEquals('foo', $stack->peek());
    $this->assertEquals(1, count($stack));
    $this->assertEquals(1, $stack->count());
    return $stack;
  }
  
  /**
   * 
   * @depends testPush
   */
  public function testPeek(StackInterface $stack) {
    $this->assertEquals('foo', $stack->peek());
    $this->assertEquals(1, count($stack));
    $this->assertEquals(1, $stack->count());
    return $stack;
  }

  /**
   * @depends testPeek
   */
  public function testPop(StackInterface $stack) {
    $this->assertEquals('foo', array_pop($stack));
    $this->assertEmpty($stack);
  }

  public function testPushAndPop() {
    $stack = new Stack();
    $this->assertEquals(0, count($stack));

    $this->assertEquals(0, $stack->count());

    $stack->push('foo');
    $this->assertEquals('foo', $stack->peek());
    $this->assertEquals(1, count($stack));

    $this->assertEquals(1, $stack->count());

    $this->assertEquals('foo', $stack->pop());
    $this->assertEquals(0, count($stack));
    $this->assertEquals(0, $stack->count());
  }

}
