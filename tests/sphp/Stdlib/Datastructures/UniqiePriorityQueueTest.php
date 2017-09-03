<?php

namespace Sphp\Stdlib\Datastructures;

class UniqiePriorityQueueTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var UniquePriorityQueue
   */
  protected $q;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp() {
    $this->q = new UniquePriorityQueue();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown() {
    unset($this->q);
  }

  public function priorityQueueData() {
    return [
        [["a", 6 => "b", "b", 2 => "b"]]
    ];
  }

  /**
   * @dataProvider priorityQueueData
   *
   * @param array $values
   */
  public function testVariableSetting(array $values) {
    $count = count(array_unique($values));
    foreach ($values as $priority => $value) {
      $this->q->enqueue($value, $priority);
    }
    $this->assertFalse($this->q->isEmpty());
    $this->assertCount($count, $this->q);
    $unique = array_unique($values);
    ksort($unique);
    //print_r($unique);
    $dequeued = [];
    while (!$this->q->isEmpty()) {
      $dequeued[] = $this->q->dequeue();
      //echo "$dequeued\n";
      //$this->assertSame($dequeued, $value);
    }
    $this->assertCount(0, $this->q);
  }

  public function uniquePriorityQueueData() {
    return [
        [[]],
        [range('a', 'o')],
        [[100 => '100', 101 => '101']],
        [[102 => '102', 1 => '1', 101 => '101']],
        [[102 => null, 1 => false, 101 => true]]
    ];
  }

  /**
   * @dataProvider uniquePriorityQueueData
   *
   * @param array $values
   */
  public function testToArray(array $values) {
    foreach ($values as $priority => $value) {
      $this->q->enqueue($value, $priority);
    }
    foreach ($this->q->toArray() as $v) {
      $dequeued = $this->q->dequeue();
      $this->assertSame($dequeued, $v);
    }
  }

  /**
   * @dataProvider uniquePriorityQueueData
   *
   * @param array $values
   */
  public function testGetIterator(array $values) {
    foreach ($values as $priority => $value) {
      $this->q->enqueue($value, $priority);
    }
    foreach ($this->q as $v) {
      $dequeued = $this->q->dequeue();
      $this->assertSame($dequeued, $v);
    }
  }

  /**
   * @dataProvider uniquePriorityQueueData
   *
   * @param array $values
   */
  public function testPeek(array $values) {
    echo "testPeek:\n";
    print_r($values);
    foreach ($values as $priority => $value) {
      $this->q->enqueue($value, $priority);
    }
    ksort($values);
    while (!$this->q->isEmpty()) {
      $first = array_shift($values);
      echo "first of array: $first\n";
      echo "peek: {$this->q->peek()}\n";
      $this->assertSame($first, $this->q->peek());
      $dequeued = $this->q->dequeue();
      $this->assertSame($first, $dequeued);
    }
  }

  /**
   * @dataProvider uniquePriorityQueueData
   *
   * @param array $values
   */
  public function testContains(array $values) {
    foreach ($values as $priority => $value) {
      $this->q->enqueue($value, $priority);
    }
    echo "count:" . $this->q->count() . "\n";
    foreach ($values as $value) {
      $this->q->contains($value);
    }
  }

}
