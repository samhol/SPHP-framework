<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Manual;

$stablePriorityQueue = Manual\api()->classLinker(StablePriorityQueue::class);
$splPriorityQueue = Manual\php()->classLinker(\SplPriorityQueue::class);

Manual\md(<<<MD
##The $stablePriorityQueue class

This class extends the build-in $splPriorityQueue.
The $stablePriorityQueue is stable whereas the native SPL class is not.

**Important:** A priority queue is said to be stable if deletions of items with equal
priority value occur in the order in which they were inserted.
MD
);

Manual\visualize('Sphp/Stdlib/Datastructures/StablePriorityQueue.php', 'text', false);
