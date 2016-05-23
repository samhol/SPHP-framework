<?php

namespace Sphp\Data;

$stack = (new Queue())
        ->enqueue("A")
        ->enqueue("B")
        ->enqueue("C");

echo "peeked: " . $stack->peek() . "\n";

while (!$stack->isEmpty()) {
  echo "popped: " . $stack->dequeue() . "\n";
}
?>