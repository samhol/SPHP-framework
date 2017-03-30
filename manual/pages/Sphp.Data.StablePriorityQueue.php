<?php
namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
$storage = $api->classLinker(StablePriorityQueue::class);
echo $parsedown->text(
		<<<MD
##The $storage class

This class extends the native SPL {$php->classLinker(\SplPriorityQueue::class)}.
The $storage is stable whereas the native SPL class is not.

**Important:** A priority queue is said to be stable if deletions of items with equal
priority value occur in the order in which they were inserted.
MD
);
CodeExampleBuilder::visualize("Sphp/Data/StablePriorityQueue.php", "php", false);
