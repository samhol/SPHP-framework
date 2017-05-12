<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$stablePriorityQueue = Apis::sami()->classLinker(StablePriorityQueue::class);
$splPriorityQueue = Apis::phpManual()->classLinker(\SplPriorityQueue::class);
echo $parsedown->text(
        <<<MD
##The $stablePriorityQueue class

This class extends the build-in $splPriorityQueue.
The $stablePriorityQueue is stable whereas the native SPL class is not.

**Important:** A priority queue is said to be stable if deletions of items with equal
priority value occur in the order in which they were inserted.
MD
);
CodeExampleBuilder::visualize("Sphp/Data/StablePriorityQueue.php", 'text', false);
