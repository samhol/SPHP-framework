<?php

namespace Sphp\Data;

use Exception;

trait StackTestTrait {

  /**
   * 
   * @return array
   */
  public function stackData() {
    return [
        [range(-100000, 100000)],
        [[null, false, true, 1, 0, "string", "", "0", 3.14]]
    ];
  }

  /**
   * @expectedException Exception
   * @expectedExceptionCode 0
   */
  public function testEmpty1() {
    echo "---trait---";
    $this->datastructure->push("value");
    $this->assertFalse($this->datastructure->isEmpty());
    $this->datastructure->pop();
    $this->assertTrue($this->datastructure->isEmpty());
    $this->datastructure->pop();
  }

  /**
   * @expectedException Exception
   * @expectedExceptionCode 0
   */
  public function testEmpty() {
    echo "---trait---";
    $this->datastructure->push("value");
    $this->assertFalse($this->datastructure->isEmpty());
    $this->datastructure->pop();
    $this->assertTrue($this->datastructure->isEmpty());
    $this->datastructure->pop();
  }

  /**
   * @expectedException Exception
   * @expectedExceptionCode 0
   */
  public function testPeekEmpty() {
    $this->datastructure->peek();
  }

  /**
   * @expectedException Exception
   * @expectedExceptionCode 0
   */
  public function testPopEmpty() {
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

}
