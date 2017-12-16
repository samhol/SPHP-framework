<?php

namespace Sphp\Stdlib\Datastructures;

class QueueTests extends \PHPUnit\Framework\TestCase {

  /**
   * @return  Queue
   */
  public function createQueue() {
    return new Queue();
  }

  protected function setUp() {
    $this->q = $this->createQueue();
  }

  protected function tearDown() {
    unset($this->q);
  }

  /**
   * 
   * @return array
   */
  public function queueData() {
    return [
        [range(-100000, 100000)],
        [[null, false, true, 1, 0, "string", "", "0", 3.14]]
    ];
  }

  /**
   * @dataProvider queueData
   * @param array $values
   */
  public function testQueueing(array $values) {
    foreach ($values as $value) {
      $this->q->enqueue($value);
    }
    $uniqueValues = array_unique($values);
    $count = count($uniqueValues);
    if ($count > 0) {
      $this->assertFalse($this->q->isEmpty());
    }
    while (!$this->q->isEmpty()) {
      $peeked = $this->q->peek();
      $dequeued = $this->q->dequeue();
      $this->assertSame($dequeued, $peeked);
    }
    $this->assertTrue($this->q->isEmpty());
  }

  /**
   * @expectedException Exception
   * @expectedExceptionCode 0
   */
  public function testEmpty() {
    $this->assertTrue($this->q->isEmpty());
    $this->q->dequeue();
  }

}
