<?php

namespace Sphp\Data;

$stack = (new Stack())
        ->push("A")
        ->push("B")
        ->push("C");

while (!$stack->isEmpty()) {
  echo "peeked: " . $stack->peek() . "\n";
  echo "popped: " . $stack->pop() . "\n";
}
?>