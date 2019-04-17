<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\UnderflowException;

class PriorityQueueTest extends TestCase {

  /**
   * @covers Sphp\Stdlib\Datastructures\PriorityQueue::__construct()
   */
  public function testConstructor() {
    $queue = new PriorityQueue();
    $this->assertSame($queue->count() === 0, $queue->isEmpty());
  }

  /**
   * 
   * @return array
   */
  public function queueData() {
    return [
        [[]],
        [range('a', 'e')],
    ];
  }

  public function testQueueing() {
    $queue = new PriorityQueue();
    $queue->enqueue('bar', 5);
    $queue->enqueue('F', 10);
    $queue->enqueue('O', 8);
    $queue->enqueue('o', 10);
    $queue->enqueue('-', 6);
    $result = '';
    foreach ($queue as $value) {
      $result .= $value;
    }
    $this->assertSame('FoO-bar', $result);
    $this->assertSame('FoO-bar', implode($queue->toArray()));
    $peeked = '';
    $dequeued = '';
    $count = 5;
    while (!$queue->isEmpty()) {
      $this->assertCount($count, $queue);
      $peeked .= $queue->peek();
      $dequeued .= $queue->dequeue();
      $count--;
    }
    $this->assertSame('FoO-bar', $peeked);
    $this->assertSame('FoO-bar', $dequeued);
  }

}
