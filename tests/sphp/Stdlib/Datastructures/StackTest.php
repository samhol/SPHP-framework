<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Exception;
use Sphp\Exceptions\UnderflowException;

class StackTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var StackInterface
   */
  protected $datastructure;

  /**
   * 
   * @return ArrayStack
   */
  public function createStack() {
    return new ArrayStack();
  }

  protected function setUp(): void {
    $this->datastructure = $this->createStack();
  }

  protected function tearDown(): void {
    unset($this->datastructure);
  }

  /**
   * 
   * @return array
   */
  public function stackData() {
    return [
        [range(-2, 2)],
        [[null, false, true, 1, 0, "string", "", "0", 3.14]]
    ];
  }

  public function testPeekEmpty() {
    $this->expectException(UnderflowException::class);
    $this->datastructure->peek();
  }

  public function testPopEmpty() {
    $this->expectException(UnderflowException::class);
    $this->datastructure->pop();
  }

  /**
   * @dataProvider stackData
   * @param array $values
   */
  public function testPushPeekAndPop($values) {
    foreach ($values as $value) {
      $this->datastructure->push($value);
    }
    $reversed = array_reverse($values);
    foreach ($reversed as $value) {
      $this->assertSame($value, $this->datastructure->peek());
      $this->assertSame($value, $this->datastructure->pop());
    }
  }

  public function testEmpty1() {
    $this->datastructure->push("value");
    $this->assertFalse($this->datastructure->isEmpty());
    $this->datastructure->pop();
    $this->assertTrue($this->datastructure->isEmpty());
    $this->expectException(UnderflowException::class);
    $this->datastructure->pop();
  }

  public function testEmpty() {
    $this->datastructure->push("value");
    $this->assertFalse($this->datastructure->isEmpty());
    $this->datastructure->pop();
    $this->assertTrue($this->datastructure->isEmpty());
    $this->expectException(UnderflowException::class);
    $this->datastructure->pop();
  }

}
