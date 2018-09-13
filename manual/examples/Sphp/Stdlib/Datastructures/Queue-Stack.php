<?php

namespace Sphp\Stdlib\Datastructures;

$queue = (new ArrayQueue())
        ->enqueue("A")
        ->enqueue("B")
        ->enqueue("C");

echo "Queue:\n";
while (!$queue->isEmpty()) {
  echo "  peeked:   " . $queue->peek() . "\n";
  echo "  dequeued: " . $queue->dequeue() . "\n";
}

echo "Stack:\n";
$stack = (new ArrayStack())
        ->push("A")
        ->push("B")
        ->push("C");

while (!$stack->isEmpty()) {
  echo "  peeked: " . $stack->peek() . "\n";
  echo "  popped: " . $stack->pop() . "\n";
}
