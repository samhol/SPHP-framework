<?php

namespace Sphp\Data;

$queue = (new Queue())
        ->enqueue("A")
        ->enqueue("B")
        ->enqueue("C");

while (!$queue->isEmpty()) {
  echo "peeked: " . $queue->peek() . "\n";
  echo "dequeued: " . $queue->dequeue() . "\n";
}
?>