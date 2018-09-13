<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Manual;

$stack = Manual\api()->classLinker(Stack::class);
$arrayStack = Manual\api()->classLinker(ArrayStack::class);

$queue = Manual\api()->classLinker(Queue::class);
$arrayQueue = Manual\api()->classLinker(ArrayQueue::class);

Manual\md(<<<MD
## The $stack and $queue interfaces

In computer science, a queue represents a First-In-First-Out (FIFO) data
structure, whereas a stack represents a last in, first out (LIFO) data structure.

The $arrayStack is a simple implementation of the $stack interface. It uses PHP arrays as its inner data structure

* {$stack->methodLink('push')}: Pushes an item onto the top of the stack
* {$stack->methodLink('pop')}: Removes the item at the top of the stack and returns that item as the value
* {$stack->methodLink('peek')}: Observes the top-most element without removing it from the stack
* {$stack->methodLink('isEmpty')}: Determine if the stack is empty or not

****

The $arrayQueue is a simple implementation of the $queue interface. It uses PHP arrays as its inner data structure.
        
* {$queue->methodLink('enqueue')}: Adds a new item to the end of the queue
* {$queue->methodLink('dequeue')}: Removes and returns the first item of the queue
* {$queue->methodLink('peek')}: Observes the first item of the queue without removing it
* {$queue->methodLink('isEmpty')}: Determine if the queue is empty or not

MD
);

Manual\visualize('Sphp/Stdlib/Datastructures/Queue-Stack.php', 'text', false);

