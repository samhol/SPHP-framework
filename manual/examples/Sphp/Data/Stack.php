<?php

namespace Sphp\Data;

$stack = (new Stack())
        ->push("A")
        ->push("B")
        ->push("C");

echo "peeked: " . $stack->peek() . "\n";

while (!$stack->isEmpty()) {
  echo "popped: " . $stack->pop() . "\n";
}
?>