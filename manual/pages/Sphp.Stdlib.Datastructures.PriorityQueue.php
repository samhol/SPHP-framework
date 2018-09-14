<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Manual;

$priorityQueue = Manual\api()->classLinker(PriorityQueue::class);
$splPriorityQueue = Manual\php()->classLinker(\SplPriorityQueue::class);

Manual\md(<<<MD
##The $priorityQueue class

This class uses the $splPriorityQueue  build-in PHP.
The $priorityQueue is stable. A priority queue is said to be stable if deletions of items with equal
priority value occur in the order in which they were inserted.
MD
);

Manual\visualize('Sphp/Stdlib/Datastructures/PriorityQueue.php', 'text', false);
