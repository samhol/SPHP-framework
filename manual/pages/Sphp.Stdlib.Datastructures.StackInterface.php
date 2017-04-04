<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$stackInterface = Apis::apigen()->classLinker(StackInterface::class);
$stack = Apis::apigen()->classLinker(Stack::class);
$splStack = Apis::phpManual()->classLinker(\SplStack::class);

$queueInterface = Apis::apigen()->classLinker(QueueInterface::class);
$queue = Apis::apigen()->classLinker(Queue::class);
$splQueue = Apis::apigen()->classLinker(\SplQueue::class);

echo $parsedown->text(<<<MD
##Stack and queue implementations

In computer science, a queue represents a First-In-First-Out (FIFO) data
structure, whereas a stack represents a last in, first out (LIFO) data structure.

####The $stackInterface and its implementation

The $stack implements the $stackInterface by extending the native $splStack.
an instance of $stack can therefore be used as a last-in-first-out (LIFO) stack of items.

* {$stackInterface->methodLink("push")}: Pushes an item onto the top of the stack
* {$stackInterface->methodLink("pop")}: Removes the item at the top of the stack and returns that item as the value
* {$stackInterface->methodLink("peek")}: Observes the top-most element without removing it from the stack
* {$stackInterface->methodLink("isEmpty")}: Determine if the stack is empty or not

MD
);
CodeExampleBuilder::visualize("Sphp/Data/Stack.php", "php", false);
echo $parsedown->text(<<<MD
####The $queueInterface and its implementation

The $queue implements the $queueInterface by extending the native $splQueue.
an instance of $queue can therefore be used as a last-in-first-out (LIFO) stack of items.

****

* {$queueInterface->methodLink("enqueue")}: Adds a new item to the end of the queue
* {$queueInterface->methodLink("dequeue")}: Removes and returns the first item of the queue
* {$queueInterface->methodLink("peek")}: Observes the first item of the queue without removing it
* {$queueInterface->methodLink("isEmpty")}: Determine if the queue is empty or not

MD
);
CodeExampleBuilder::visualize("Sphp/Data/Queue.php", "php", false);
