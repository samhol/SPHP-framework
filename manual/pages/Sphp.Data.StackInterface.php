<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$stackInterface = $api->classLinker(StackInterface::class);
$stack = $api->classLinker(Stack::class);
$splStack = $php->classLinker(\SplStack::class);

$queueInterface = $api->classLinker(QueueInterface::class);
$queue = $api->classLinker(Queue::class);
$splQueue = $php->classLinker(\SplQueue::class);

echo $parsedown->text(<<<MD
##Stack and queue implementations

In computer science, a queue represents a First-In-First-Out (FIFO) data
structure, whereas a stack represents a last in, first out (LIFO) data structure.

####The $stackInterface and its implementation

The $stack implements the $stackInterface by extending the native $splStack.
an instance of $stack can therefore be used as a last-in-first-out (LIFO) stack of items.

* {$stackInterface->method("push")}: Pushes an item onto the top of the stack
* {$stackInterface->method("pop")}: Removes the item at the top of the stack and returns that item as the value
* {$stackInterface->method("peek")}: Observes the top-most element without removing it from the stack
* {$stackInterface->method("isEmpty")}: Determine if the stack is empty or not

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/Stack.php", "php", false);
echo $parsedown->text(<<<MD
####The $queueInterface and its implementation

The $queue implements the $queueInterface by extending the native $splQueue.
an instance of $queue can therefore be used as a last-in-first-out (LIFO) stack of items.

****

* {$queueInterface->method("enqueue")}: Adds a new item to the end of the queue
* {$queueInterface->method("dequeue")}: Removes and returns the first item of the queue
* {$queueInterface->method("peek")}: Observes the first item of the queue without removing it
* {$queueInterface->method("isEmpty")}: Determine if the queue is empty or not

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/Queue.php", "php", false);
?>
