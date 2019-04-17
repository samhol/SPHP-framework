<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Sphp\Exceptions\UnderflowException;

class UniquePriorityQueueTest extends \PHPUnit\Framework\TestCase {

  /**
   * @covers Sphp\Stdlib\Datastructures\PriorityQueue::__construct()
   */
  public function testConstructor() {
    $queue = new UniquePriorityQueue();
    $this->assertSame($queue->count() === 0, $queue->isEmpty());
  }

  public function testRemoving() {
    $queue = new UniquePriorityQueue();
    $queue->enqueue('BAR', 5);
    $queue->enqueue('F', 10);
    $queue->enqueue('O', 8);
    $queue->enqueue('O', 10);
    $queue->enqueue('-', 6);
    $queue->remove('O');
    $this->assertSame('F-BAR', implode($queue->toArray()));
    $queue->remove('BAR');
    $queue->remove('-');
    $queue->remove('F');
    $this->assertEmpty($queue->toArray());
  }
  public function testEmptyPeek() {
    $queue = new UniquePriorityQueue();
    $this->expectException(UnderflowException::class);
    $queue->peek();
  }

  public function testEmptyDequeue() {
    $queue = new UniquePriorityQueue();
    $this->expectException(UnderflowException::class);
    $queue->dequeue();
  }

  public function testQueueing() {
    $queue = new UniquePriorityQueue();
    $queue->enqueue('bar', 5);
    $queue->enqueue('F', 10);
    $queue->enqueue('O', 8);
    $queue->enqueue('o', 10);
    $queue->enqueue('-', 6);
    $this->assertSame('FoO-bar', implode(iterator_to_array($queue)));
    $this->assertSame('FoO-bar', implode($queue->toArray()));
    $peeked = '';
    $dequeued = '';
    $count = 5;
    while (!$queue->isEmpty() && $count !== 0) {
      $this->assertCount($count, $queue);
      $peek = $queue->peek();
      $peeked .= $peek;
      $this->assertTrue($queue->contains($peek));
      $dequeued .= $queue->dequeue();
      $this->assertFalse($queue->contains($peek));
      $count--;
    }
    $this->assertSame('FoO-bar', $peeked);
    $this->assertSame('FoO-bar', $dequeued);
  }

}
