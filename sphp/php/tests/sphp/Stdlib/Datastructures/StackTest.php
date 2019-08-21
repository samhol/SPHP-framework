<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Datastructures\Stack;
use Sphp\Exceptions\UnderflowException;

abstract class StackTest extends TestCase {

  /**
   * @return Stack
   */
  abstract public function createStack(): Stack;

  public function testDefaultConstructor(): Stack {
    $stack = $this->createStack();
    $this->assertTrue($stack->isEmpty());
    return $stack;
  }

  /**
   * @depends testDefaultConstructor
   * @param Stack $stack
   */
  public function testPeekEmpty(Stack $stack) {
    $this->expectException(UnderflowException::class);
    $stack->peek();
  }

  /**
   * @depends testDefaultConstructor
   * @param Stack $stack
   */
  public function testPopEmpty(Stack $stack) {
    $this->expectException(UnderflowException::class);
    $stack->pop();
  }

  public function stackingData(): array {
    $data = [];
    $array = range('a', 'f');
    $array['obj'] = new \stdClass();
    $data[] = [$array];
    return $data;
  }

  /**
   * @dataProvider stackingData
   * @param array $array
   */
  public function testStackMethods(array $array): void {
    $stack = $this->createStack();
    foreach ($array as $value) {
      $this->assertSame($stack, $stack->push($value));
      $this->assertFalse($stack->isEmpty());
      $this->assertSame($value, $stack->peek());
    }
    while (!empty($array)) {
      $expected = array_pop($array);
      $this->assertSame($expected, $stack->peek());
      $this->assertSame($expected, $stack->pop());
    }
    $this->assertTrue($stack->isEmpty());
  }

}
