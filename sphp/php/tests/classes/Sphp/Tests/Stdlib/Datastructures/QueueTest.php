<?php

declare(strict_types=1);

namespace Sphp\Tests\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Stdlib\Datastructures\ArrayQueue;
use Sphp\Exceptions\UnderflowException;

class QueueTest extends TestCase {

  protected ArrayQueue $q;

  protected function setUp(): void {
    $this->q = new ArrayQueue();
  }

  protected function tearDown(): void {
    unset($this->q);
  }

  /**
   * 
   * @return array
   */
  public function constructData() {
    return [
        [[]],
        [range('a', 'e')],
    ];
  }

  /**
   * @dataProvider constructData
   * @param array $values
   */
  public function testConstructor(array $values) {
    $queue = new ArrayQueue($values);
    $this->assertSame(count($values) === 0, $queue->isEmpty());
    if (count($values) === 0) {
      $this->expectException(UnderflowException::class);
      $queue->peek();
    } else {
      $this->assertSame(reset($values), $queue->peek());
    }
  }

  /**
   * 
   * @return array
   */
  public function queueData() {
    return [
        [range(-2, 2)],
        [range('a', 'e')],
    ];
  }

  /**
   * @dataProvider queueData
   * 
   * @param  array $values
   * @return void
   */
  public function testQueueing(array $values): void {
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

  public function testEmpty(): void {
    $this->assertTrue($this->q->isEmpty());
    $this->expectException(UnderflowException::class);
    $this->q->dequeue();
  }

}
